<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


use App\Mail\ResumeAdd;

use App\Models\Form;
use App\Models\FormAnswer;
use App\Models\FormField;
use App\Models\FormFieldVariant;
use App\Models\Company;
use App\Models\Resume;
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;

use App\ESh\Telegram;
use App\ESh\Viber;
use App\ESh\Helper;

use PDF;

class FormController extends BaseController
{
    public function publicCreate($companyCode, $formId, Request $request)
    {
        

        $company = Company::where(['code' => $companyCode])->first();

        if(empty($company)){
            abort(404);
        }

        $form = Form::where(['id' => $formId, 'company_id' => $company->id])->first();
        
        if(empty($form)){
            abort(404);
        }

        $formsField = FormField::where(['form_id' => $formId])->get();
        

        return view('public.forms.show', [
            'company' => $company,
            'form' => $form,
            'formsField' => $formsField,
        ]);
    }

    public function publicStore(Request $request)
    {
        $arFields = $request->post('info');
        $arFiles = $request->post('files');
        $arExperience = $request->post('experience');
        $arEducation = $request->post('education');

        $company = Company::where(['code' => $request->post('company_code')])->first();
       
        $resume = new Resume();
        $resume->is_active = 1;
        $resume->sort = 100;
        $resume->points = 0;
        $resume->form_id = $request->post('form_id');
        $resume->user_id = $company->user_id;
        $resume->company_id = $company->id;
        
        $resume->name = $arFields['resume:name'];
        $resume->second_name = $arFields['resume:second_name'];
        $resume->last_name = $arFields['resume:last_name'];
        $resume->phone = $arFields['resume:phone'];
        $resume->email = $arFields['resume:email'];
        $resume->resume_status_id = 1;
        $resume->description = '';
        $resume->code = rand(1000,9999).time().rand(1000,9999);
                
        $resume->save();

        foreach ($arExperience as $key => $field) {
            
            if($field['company_name'] != '' && $field['period'] != ''){
                $experience = new Experience();
                $experience->company_name = $field['company_name'];
                $experience->period = $field['period'];
                $experience->position = $field['position'];
                $experience->description = nl2br($field['description']);
                $experience->resume_id = $resume->id;
                $experience->company_id = $company->id;
                $experience->save();
            }

        }

        unset($field);
        unset($key);

        foreach ($arEducation as $key => $field) {

            if($field['place'] != '' && $field['period'] != ''){

                $education = new Education();
                $education->place = $field['place'];
                $education->period = $field['period'];
                $education->specialisation = $field['specialisation'];
                $education->resume_id = $resume->id;
                $education->company_id = $company->id;
                $education->save();

            }
        }

        unset($field);
        unset($key);

        foreach ($arFields as $key => $field) {
            
            $fieldId = explode(':', $key)[1];
            $hasValue = false;
            $fieldVariantId = null;
            $points = 0;

            if(strstr($fieldId, '#')){
                
                $arString = explode('#', $fieldId);
                $hasValue = true;
                $fieldId = $arString[0];
                $fieldVariantId = $arString[1];
                
                if($field != null){
                    $points = FormFieldVariant::where('id', $fieldVariantId)->first()->points;
                    $resume->points += $points;
                }

                
                

            }else if(intval($fieldId) > 0){
                $hasValue = true;
            }


            if($hasValue && $field != null){
                $answer = new FormAnswer();
                $answer->sort = 100;
                $answer->points = $points;
                $answer->answer = $field;
                $answer->is_active = 1;
                $answer->resume_id = $resume->id;
                $answer->forms_fields_variants_id = $fieldVariantId;
                $answer->field_id = $fieldId;
                $answer->form_id = $resume->form_id;
                $answer->company_id = $company->id;
                $answer->save();
            }

        }

        $user = User::find($company->user_id);
                
        //save files
        if(count($arFiles) > 0){
            foreach ($arFiles as $key => $file) {

                $userPhoto = $resume->files()->create([ 
                    'description' => '-',
                    'url' => $file['url'],
                    'original_name' => $file['original_name'],
                    'name' => $file['name'],
                    'company_id' => $resume->company_id,
                    'user_id' => $resume->user_id,
                ]);
                
                
                $resume->photo_id = intval($userPhoto->id);
            }
        }
        
        $resume->save();

        $data = Resume::getDataForPDF($resume->id);
        view()->share('data', $data);
                
        $pdf = PDF::loadView('mng.resume.download-pdf', $data);
        $url = config('APP_URL').route('resume.detail', $resume->id);
        Mail::to($user)->send(new ResumeAdd($resume, $url, $pdf));
        
        //send to telegram
        if($user->telegram){

            $host = 'http://resume.i-aos.ru';
            $pdf_name = $resume->id.time().".pdf";
            $path = '/upload/pdf/resume/'.$pdf_name;
            $pdf->save(public_path($path));

            Telegram::sendMessageProxy($user->telegram, 'Новое резюме от '.$resume->full_name.' / '.$resume->phone); 
            Telegram::sendFile($user->telegram, $host.$path);

        }

        if($user->viber){ 
            Viber::sendMessage($user->viber, 'Новое резюме от '.$resume->full_name.' / '.$resume->phone); 
        }
      

        $data = ['success' => 'Y'];
        return response()->json($data, 200);


    }

    public function index(){
        
        Viber::sendMessage('jcpsjyoW66yBbcU7iD5qtA==jcpsjyoW66yBbcU7iD5qtA==',[],'Test'); 

        $companyCode = Auth::user()->company->code;
        $forms = Form::where(['user_id' => Auth::id()])->orderBy('id','desc')->withCount('resume')->paginate(5); 
        
        return view('mng.forms.list', ['forms' => $forms, 'companyCode' => $companyCode]);

    }

    public function show(){

    }

    public function create(){
        return view('mng.forms.create');
    }

    public function edit(){

    }

    public function store(Request $request){
        //dd($request->post('fields'));
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;

        $arForm = $request->post('form');
        $arFields = $request->post('fields');
        $arFieldsVariant = $request->post('fieldsVariant');

        $form = new Form();
        $form->name = $arForm['name'];
        $form->code = Helper::translit($arForm['name']);
        $form->is_active = 1;
        $form->sort = 100;
        $form->user_id = $userId;
        $form->company_id = $companyId;
        $form->save();

        foreach($arFields as $key => $arField){

            $field = new FormField();
            $field->name = $arField['name'];
            $field->code = Helper::translit($arField['name']);
            $field->description = $arField['description'];
            $field->step = $arField['step'];
            $field->is_required = $arField['required'];
            $field->sort = $arField['sort'];
            $field->type = $arField['type'];
            $field->size = $arField['size'];
            $field->is_active = 1;
            $field->form_id = $form->id;
            $field->user_id = $userId;
            $field->company_id = $companyId;
            $field->save();

            if($arField['type'] == 3){

                foreach($arFieldsVariant as $arFieldVariant){
                    
                    if($arFieldVariant['field_id'] == $key){

                        if($arFieldVariant['name'] != ''){
                        
                            $fieldVariant = new FormFieldVariant();
                            $fieldVariant->name = $arFieldVariant['name'];
                            $fieldVariant->description = $arFieldVariant['description'];
                            $fieldVariant->points = $arFieldVariant['points'];
                            $fieldVariant->sort = $arFieldVariant['sort'];
                            $fieldVariant->is_active = 1;
                            $fieldVariant->field_id = $field->id;
                            $fieldVariant->form_id = $form->id;
                            $fieldVariant->user_id = $userId;
                            $fieldVariant->company_id = $companyId;
                            $fieldVariant->save();

                        }
                    }
                    
                }

            }

        }

        return response()->json([
            'id' => $form->id,
            'status' => 'success'
        ]);

    }

    public function update(){

    }

}
