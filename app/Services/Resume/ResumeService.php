<?
namespace App\Services\Resume;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Mail\ResumeAdd;

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

use App\Models\Form\FormField;
use App\Models\Form\FormFieldVariant;
use App\Models\Company;
use App\Models\Resume\Resume;
use App\Models\Resume\Education;
use App\Models\Resume\Experience;
use App\Models\Form\FormAnswer;
use App\Models\User;

use App\ESh\Telegram;
use App\ESh\Viber;


class ResumeService{
          
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

  
   public function changeStatus($resumeId, $statusId)
   {
        $resume = $this->resumeRepository->getById($resumeId);
        $resume->resume_status_id = $statusId;
        $resume->save();

        return $resume;
   }

   public function changePoints($resumeId, $fields)
   {
        $resume = $this->resumeRepository->getById($resumeId);
        
        foreach ($fields as $key => $field) {
            $answer = $this->formAnswerRepository->getByID($key);
            $answer->points = $field;
            $answer->save();
        }

        $points = $this->formAnswerRepository->getPoints($resume->form_id, $resume->id);
        $resume->points = $points;
        $resume->save();    

        return $resume;
   }

   public function getDetailInfo($id) : array
   {

    $data = [];

    $data['resume'] = $this->resumeRepository->getById($id);
    $data['form'] = $this->formRepository->getById($data['resume']->form_id);

    $data['formFields'] = FormField::where(['form_id' => $data['resume']->form_id])->with(['answers' => function($query) use($id){
        $query->where('forms_answers.resume_id', '=', $id);
    }])->get();

    $data['resumeStatuses'] = $this->resumeStatusRepository->all();
    $data['experience'] = $this->experienceRepository->getByColumn('resume_id', $data['resume']->id);
    $data['education'] = $this->educationRepository->getByColumn('resume_id', $data['resume']->id);
    $data['userPhoto'] = $this->fileRepository->getById($data['resume']->photo_id);

    return $data;

    }

    public function getDetailAdditionalInfo($id) : array
    {

        $data['testResults'] = $this->testResultRepository->getByColumnWith('resume_id', $id, 'test:id,name');
        $data['testAssign'] = $this->testResumeRepository->getByColumnWith('resume_id', $id, 'test:id,name');
        $data['interviews'] = $this->interviewRepository->getByColumn('resume_id', $id);

        return $data;

    }

    public function saveResume($formId, $company, $arFields)
    {
        $resume = new Resume();
        $resume->is_active = 1;
        $resume->sort = 100;
        $resume->points = 0;
        $resume->form_id = $formId;
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

        return $resume;
    }

    public function saveExperience($resumeId, $companyId, $arExperience)
    {
        foreach ($arExperience as $key => $field) {
            
            if($field['company_name'] != '' && $field['period'] != ''){
                $experience = new Experience();
                $experience->company_name = $field['company_name'];
                $experience->period = $field['period'];
                $experience->position = $field['position'];
                $experience->description = nl2br($field['description']);
                $experience->resume_id = $resumeId;
                $experience->company_id = $companyId;
                $experience->save();
            }

        }

        unset($field);
        unset($key);
    }

    public function saveEducation($resumeId, $companyId, $arEducation)
    {
        foreach ($arEducation as $key => $field) {

            if($field['place'] != '' && $field['period'] != ''){

                $education = new Education();
                $education->place = $field['place'];
                $education->period = $field['period'];
                $education->specialisation = $field['specialisation'];
                $education->resume_id = $resumeId;
                $education->company_id = $companyId;
                $education->save();

            }
        }

        unset($field);
        unset($key);
    }

    public function savePhoto(Resume $resume,array $arFiles)
    {
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

        return $resume;
    }

    public function saveAnswers($formId, $resumeId, $companyId, $arFields)
    {
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
                    $points += $points;
                }

                
                

            }else if(intval($fieldId) > 0){
                $hasValue = true;
            }


            if($hasValue && $field != null){
                $answer = new FormAnswer();
                $answer->sort = 100;
                $answer->points = $points;
                $answer->answer = nl2br($field);
                $answer->is_active = 1;
                $answer->resume_id = $resumeId;
                $answer->forms_fields_variants_id = $fieldVariantId;
                $answer->field_id = $fieldId;
                $answer->form_id = $formId;
                $answer->company_id = $companyId;
                $answer->save();
            }

        }

        return $points;
    }

    public function notifyUser($user, $resume, $pdf)
    {
        $url = config('app.url').route('resume.detail', $resume->id);

        Mail::to($user)->send(new ResumeAdd($resume, $url, $pdf));
        
        //send to telegram
        if($user->telegram){

            $host = config('app.url');
            $pdf_name = $resume->id.time().".pdf";
            $path = '/upload/pdf/resume/'.$pdf_name;
            $pdf->save(public_path($path));

            Telegram::sendMessageProxy($user->telegram, 'Новое резюме от '.$resume->full_name.' / '.$resume->phone); 
            Telegram::sendFile($user->telegram, $host.$path);

        }

        if($user->viber){ 
            Viber::sendMessage($user->viber, 'Новое резюме от '.$resume->full_name.' / '.$resume->phone); 
            $fileSize = File::size(public_path($path));
            Viber::sendFile($user->viber , 'Резюме.pdf', $host.$path, $fileSize);
        }
    }



   

}