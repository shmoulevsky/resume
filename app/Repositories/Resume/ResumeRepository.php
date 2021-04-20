<?
namespace App\Repositories\Resume;

use App\Models\Resume\Resume;

use App\Repositories\Interfaces\Resume\ResumeRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResumeRepository extends BaseRepository implements ResumeRepositoryInterface{

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
        return $this->model->where(['user_id' => $user_id])->orderBy('id','desc')->with(['form'])->paginate($page);
   }

   public function getListId($user_id): Collection
   {
        return $this->model->where(['user_id' => $user_id])->select('id')->orderBy('id','desc')->get();
   }

   public function getGroupedByStatus($user_id): Collection
   {
        return $this->model->where(['user_id' => $user_id])->orderBy('id','desc')->with(['form'])->get()->groupBy('resume_status_id');
   }
   
   public function getWithComments($id): Resume
   {
        return $this->model->where(['id' => $id])->with('comments')->first();
   }
   

   public function getDataForPDF($id): Resume
   {

   }

   public function getByCode($code, $company): Resume
   {
        return $this->model->where(['code' => $code, 'company_id' => $company])->first();
   }

   
}