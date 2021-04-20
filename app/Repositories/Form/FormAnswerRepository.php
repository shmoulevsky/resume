<?
namespace App\Repositories\Form;

use App\Models\Form\FormAnswer;

use App\Repositories\Interfaces\Form\FormAnswerRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class FormAnswerRepository extends BaseRepository implements FormAnswerRepositoryInterface{

   
   public function __construct(FormAnswer $model)
   {
       parent::__construct($model);
   }

   public function getPoints($formId, $resumeId)
   {
        return DB::table('forms_answers')->where(['form_id' => $formId,'resume_id' => $resumeId])->sum('points');
   }

     
   

   
}