<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\File;
use App\Models\Form;
use App\Models\FormAnswer;
use App\Models\FormField;
use App\Models\Company;
use App\Models\Resume;
use App\Models\ResumeStatus;
use App\Models\TestResult;
use App\Models\TestResume;
use App\Models\Interview;
use App\Models\Education;
use App\Models\Experience;
use PDF;

class ResumeController extends BaseController
{
    public function index(){

        
        $resumes = Resume::where(['user_id' => Auth::id()])->orderBy('id','desc')->with(['form'])->paginate(5); 
        return view('mng.resume.list', ['resumes' => $resumes]);

    }

    public function indexCanban(){

        $resumeStatuses = ResumeStatus::all();
        
        $resumes = Resume::where(['user_id' => Auth::id()])->orderBy('id','desc')->with(['form'])->get()->groupBy('resume_status_id');
       
               
        return view('mng.resume.canban', compact('resumes', 'resumeStatuses'));

    }

    public function show($id, Request $request){

        $user = Auth::user();
        $companyId = $user->company;
        $resume = Resume::where(['id' => $id])->with('comments')->first();

        if(empty($resume)){
            abort(404);
        }

        $form = Form::where(['id' => $resume->form_id])->first();
        $formFields = FormField::where(['form_id' => $resume->form_id])->with(['answers' => function($query) use($id){
            $query->where('forms_answers.resume_id', '=', $id);
        }])->get();
        
        $resumeStatuses = ResumeStatus::all();
        
        $testResults = TestResult::where(['resume_id' => $resume->id])->with('test:id,name')->get();
        $testAssign = TestResume::where(['resume_id' => $resume->id])->with('test:id,name')->get();
        $interviews = Interview::where(['resume_id' => $resume->id])->get();
        $experience = Experience::where(['resume_id' => $resume->id])->get();
        $education = Education::where(['resume_id' => $resume->id])->get();

        $userPhoto = File::where(['id' => $resume->photo_id])->first();

        return view('mng.resume.detail', compact('resume','form','formFields', 'resumeStatuses','testResults','testAssign','interviews','companyId','experience','education','userPhoto'));

    }

    public function exportPDF($id, Request $request){

        $user = Auth::user();
        $data = Resume::getDataForPDF($id);
        view()->share('data', $data);
        $pdf = PDF::loadView('mng.resume.download-pdf', $data);
        return $pdf->download('cv-'.$data['resume']->fullname.'.pdf');

    }

    public function changeStatus(Request $request){

        $user = Auth::user();
        $resume = Resume::findOrFail(['id' => $request->post('resume_id')])->first();
        $resume->resume_status_id = $request->post('status_id');
        $resume->save();
        
        return response()->json([
            'status' => 'success'
        ]);

    }

    public function changePoints(Request $request){

        $user = Auth::user();
        $resume = Resume::findOrFail(['id' => $request->post('resume_id')])->first();
        $points = $request->post('fields');

        foreach ($points as $key => $point) {
            $answer = FormAnswer::findOrFail($key);
            $answer->points = $point;
            $answer->save();
        }

        $points = DB::table('forms_answers')->where(['form_id' => $resume->form_id,'resume_id' => $resume->id])
        ->sum('points');

        $resume->points = $points;
        $resume->save();
        
        return response()->json([
            'status' => 'success'
        ]);

    }

    public function showPublic(Request $request, $company, $code){

        
        $resume = Resume::where(['code' => $code, 'company_id' => $company])->first();
        $company = Company::findOrFail($company);
        
        if(empty($resume)){
            abort(404);
        }

        $form = Form::findOrFail($resume->form_id);
        $testResume = TestResume::where(['resume_id' => $resume->id])->with('test:id,name')->get();

        if(empty($testResume)){
            abort(404);
        }

        return view('public.resume.show', compact('resume','testResume','company','form'));
        

    }

    

}
