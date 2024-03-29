<?php
namespace App\Services\Form;


use App\Repositories\Interfaces\Resume\ResumeRepositoryInterface;
use App\Repositories\Interfaces\Resume\ResumeStatusRepositoryInterface;
use App\Repositories\Interfaces\Resume\ExperienceRepositoryInterface;
use App\Repositories\Interfaces\Resume\EducationRepositoryInterface;
use App\Repositories\Interfaces\Resume\InterviewRepositoryInterface;
use App\Repositories\Interfaces\Form\FormRepositoryInterface;
use App\Repositories\Interfaces\Form\FormFieldRepositoryInterface;
use App\Repositories\Interfaces\Form\FormAnswerRepositoryInterface;
use App\Repositories\Interfaces\Test\TestResultRepositoryInterface;
use App\Repositories\Interfaces\Test\TestResumeRepositoryInterface;
use App\Repositories\Interfaces\FileRepositoryInterface;

use App\Models\Form\Form;
use App\Models\Form\FormField;
use Illuminate\Support\Facades\Auth;

class FormService{

   public function __construct(
       ResumeRepositoryInterface $resumeRepository,
       ResumeStatusRepositoryInterface $resumeStatusRepository,
       FormRepositoryInterface $formRepository,
       FormFieldRepositoryInterface $formFieldRepository,
       FormAnswerRepositoryInterface $formAnswerRepository,
       TestResultRepositoryInterface $testResultRepository,
       TestResumeRepositoryInterface $testResumeRepository,
       InterviewRepositoryInterface $interviewRepository,
       ExperienceRepositoryInterface $experienceRepository,
       EducationRepositoryInterface $educationRepository,
       FileRepositoryInterface $fileRepository

       )
    {
       $this->resumeRepository = $resumeRepository;
       $this->experienceRepository = $experienceRepository;
       $this->educationRepository = $educationRepository;
       $this->interviewRepository = $interviewRepository;
       $this->resumeStatusRepository = $resumeStatusRepository;

       $this->formRepository = $formRepository;
       $this->formFieldRepository = $formFieldRepository;
       $this->formAnswerRepository = $formAnswerRepository;

       $this->testResultRepository = $testResultRepository;
       $this->testResumeRepository = $testResumeRepository;

       $this->fileRepository = $fileRepository;

    }

    public function saveForm(array $arForm,array $arFields,int $formId, ?array $arFieldsVariant) : Form
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        return $this->formRepository->saveForm($arForm, $arFields, $arFieldsVariant, $userId, $formId, $companyId);
    }

    public function getDataForEditForm($id)
    {
        $companyId = Auth::user()->company->id;

        $form = Form::where(['id' => $id, 'company_id' => $companyId])->first();

        if (empty($form)) {
            abort(404);
        }

        $formsField = FormField::where(['form_id' => $form->id])->get();

        return [$form, $formsField];
    }










}
