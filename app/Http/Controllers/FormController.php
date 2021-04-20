<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Form\Form;

use App\Models\Form\FormField;
use App\Models\Form\FormFieldVariant;
use App\Models\Company;
use App\Models\Resume\Resume;
use App\Models\Resume\Education;
use App\Models\Resume\Experience;
use App\Models\Form\FormAnswer;
use App\Models\User;
use PDF;


use App\Services\Resume\ResumeService;
use App\Services\Form\FormService;

class FormController extends BaseController
{
    public function __construct(
        ResumeService $resumeService,
        FormService $formService
    ) {
        $this->resumeService = $resumeService;
        $this->formService = $formService;
    }

    public function publicCreate($companyCode, $formId, Request $request)
    {


        $company = Company::where(['code' => $companyCode])->first();

        if (empty($company)) {
            abort(404);
        }

        $form = Form::where(['id' => $formId, 'company_id' => $company->id])->first();

        if (empty($form)) {
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
        $formId = intval($request->input('form_id'));

        $resume = $this->resumeService->saveResume($formId, $company, $arFields);
        $this->resumeService->saveExperience($resume->id, $company->id, $arExperience);
        $this->resumeService->saveEducation($resume->id, $company->id, $arEducation);
        $resume->points = $this->resumeService->saveAnswers($formId, $resume->id, $company->id, $arFields);

        $this->resumeService->savePhoto($resume, $arFiles);

        $data = $this->resumeService->getDetailInfo($resume->id);
        view()->share('data', $data);

        $pdf = PDF::loadView('mng.resume.download-pdf', $data);
        $user = User::find($company->user_id);

        $this->resumeService->notifyUser($user, $resume, $pdf);

        $data = ['success' => 'Y'];
        return response()->json($data, 200);
    }

    public function index()
    {

        $companyCode = Auth::user()->company->code;
        $forms = $this->formService->formRepository->getListPaginateWithResumeCount(Auth::id(), 5);

        return view('mng.forms.list', ['forms' => $forms, 'companyCode' => $companyCode]);
    }

    public function show()
    {
    }

    public function create()
    {
        return view('mng.forms.create');
    }

    public function edit(Request $request, $id)
    {


        $companyId = Auth::user()->company->id;

        $form = Form::where(['id' => $id, 'company_id' => $companyId])->first();

        if (empty($form)) {
            abort(404);
        }

        $formsField = FormField::where(['form_id' => $form->id])->get();

        return view('mng.forms.edit', compact('form', 'formsField'));
    }

    public function store(Request $request)
    {

        $userId = Auth::id();
        $companyId = Auth::user()->company->id;

        $arForm = $request->post('form');
        $arFields = $request->post('fields');
        $arFieldsVariant = $request->post('fieldsVariant');
        $formId = intval($request->post('form_id'));

        $form = $this->formService->formRepository->saveForm($arForm, $arFields, $arFieldsVariant, $userId, $formId, $companyId);

        return response()->json([
            'id' => $form->id,
            'status' => 'success'
        ]);
    }

    public function delete($id, Request $request)
    {

        $item = $this->formService->formRepository->getById($id);
        $item->delete();
        $request->session()->flash('status', 'Запись удалена');

        return response()->json(['status' => 'deleted']);
    }
}
