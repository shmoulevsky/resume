<?php

namespace App\Repositories\Resume;

use App\Models\Company;
use App\Models\Resume\Resume;

use App\Models\Resume\ResumeData;
use App\Repositories\Interfaces\Resume\ResumeRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResumeRepository extends BaseRepository implements ResumeRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Resume $model
     */
    public function __construct(Resume $model)
    {
        parent::__construct($model);
    }


    public function getListPaginate($user_id, $page): LengthAwarePaginator
    {
        return $this->model->where(['user_id' => $user_id])->orderBy('id', 'desc')->with(['form'])->paginate($page);
    }

    public function getListId($user_id): Collection
    {
        return $this->model->where(['user_id' => $user_id])->select('id')->orderBy('id', 'desc')->get();
    }

    public function getGroupedByStatus($user_id): Collection
    {
        return $this->model->where(['user_id' => $user_id])->orderBy('id', 'desc')->with(['form'])->get()->groupBy('resume_status_id');
    }

    public function getWithComments($id): Resume
    {
        return $this->model->where(['id' => $id])->with('comments')->first();
    }


    public function getByCode($code, $company): Resume
    {
        return $this->model->where(['code' => $code, 'company_id' => $company])->first();
    }

    public function saveResumeForm(int $formId, Company $company, ResumeData $resumeData): Resume
    {
        $resume = new Resume();
        $resume->is_active = true;
        $resume->sort = 100;
        $resume->points = 0;
        $resume->form_id = $formId;
        $resume->user_id = $company->user_id;
        $resume->company_id = $company->id;

        $resume->name = $resumeData->name;
        $resume->second_name = $resumeData->second_name;
        $resume->last_name = $resumeData->last_name;
        $resume->phone = $resumeData->phone;
        $resume->email = $resumeData->email;
        $resume->resume_status_id = 1;
        $resume->description = '';
        $resume->code = rand(1000, 9999) . time() . rand(1000, 9999);

        $resume->save();

        return $resume;
    }


}
