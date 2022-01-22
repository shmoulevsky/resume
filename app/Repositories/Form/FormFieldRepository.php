<?php
namespace App\Repositories\Form;

use App\Models\Form\FormField;

use App\Repositories\Interfaces\Form\FormFieldRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;


class FormFieldRepository extends BaseRepository implements FormFieldRepositoryInterface{

   
   public function __construct(FormField $model)
   {
       parent::__construct($model);
   }

   public function getFiledsWithAnswers($formId)
   {
       return $this->model->where(['form_id' => $formId])->with(['answers' => function($query) use($id){
        $query->where('forms_answers.resume_id', '=', $id);
    }])->get();
   }

     
   

   
}