<?php


namespace App\Http\Controllers\User;


use App\ESh\Helper;
use App\Models\Company;
use App\Models\Form\Form;
use App\Models\Form\FormField;
use App\Models\Resume\ResumeData;
use App\Models\User;
use App\Services\Form\FormService;
use App\Services\Resume\ResumeService;
use Illuminate\Http\Request;

class UserResumeController
{
    public function __construct(
        ResumeService $resumeService,
        FormService $formService
    ) {
        $this->resumeService = $resumeService;
        $this->formService = $formService;
    }

    public function create($companyCode, $formId, Request $request)
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

        return view('public.forms.show', compact('company', 'form', 'formsField'));
    }

    public function store(Request $request)
    {
        $formId = intval($request->input('form_id'));
        $arFormFields = $request->post('info');
        $arFiles = Helper::checkNullArray($request->post('files'));
        $arExperience = Helper::checkNullArray($request->post('experience'));
        $arEducation = Helper::checkNullArray($request->post('education'));
        $resumeData = new ResumeData($arFormFields['resume:name'], $arFormFields['resume:second_name'], $arFormFields['resume:last_name'], $arFormFields['resume:phone'], $arFormFields['resume:email']);

        $company = Company::where(['code' => $request->post('company_code')])->first();

        $resume = $this->resumeService->saveResume($formId, $company, $arExperience, $arEducation, $resumeData, $arFiles, $arFormFields);
        $pdf = $this->resumeService->makePDF($resume->id);

        $user = User::find($company->user_id);
        //$this->resumeService->notifyUser($user, $resume, $pdf);

        $data = ['success' => 'Y'];
        return response()->json($data, 200);
    }

    public function show(Request $request, $companyId, $code)
    {


        $resume = $this->resumeService->resumeRepository->getByCode($code, $companyId);
        $company = Company::findOrFail($companyId);

        if (empty($resume)) {
            abort(404);
        }

        $form = $this->resumeService->formRepository->getById($resume->form_id);
        $testResume = $this->resumeService->testResumeRepository->getByColumnWith('resume_id', $resume->id, 'test:id,name');

        if (empty($testResume)) {
            abort(404);
        }

        return view('public.resume.show', compact('resume', 'testResume', 'company', 'form'));
    }
}
