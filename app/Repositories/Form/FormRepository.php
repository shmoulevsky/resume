<?
namespace App\Repositories\Form;

use App\Models\Form\Form;
use App\Models\Form\FormField;
use App\Models\Form\FormFieldVariant;

use App\Repositories\Interfaces\Form\FormRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

use App\ESh\Helper;

class FormRepository extends BaseRepository implements FormRepositoryInterface{

   
   public function __construct(Form $model)
   {
       parent::__construct($model);
   }

   public function getListPaginateWithResumeCount($user_id, $page)
   {
       return $this->model->where(['user_id' => $user_id])->orderBy('id','desc')->withCount('resume')->paginate($page);
   }

   public function saveForm($arForm, $arFields, $arFieldsVariant, $userId, $formId, $companyId)
   {
        if($formId == 0){
            $form = new Form();
        }else{
            $form = Form::find($formId);
        }

        $form->name = $arForm['name'];
        $form->code = Helper::translit($arForm['name']);
        $form->is_active = 1;
        $form->sort = 100;
        $form->user_id = $userId;
        $form->company_id = $companyId;
        $form->save();

        foreach($arFields as $key => $arField){

            if(strstr($key, 'new')){
                $field = new FormField();
            }else{
                $field = FormField::find($key);
            }
            
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

                foreach($arFieldsVariant as $keyV => $arFieldVariant){
                    
                    if($arFieldVariant['field_id'] == $key){

                        if($arFieldVariant['name'] != ''){
                            
                            if(strstr($keyV, 'new')){
                                $fieldVariant = new FormFieldVariant();
                            }else{
                                $fieldVariant = FormFieldVariant::find($keyV);
                            }
                            
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
    
        return $form;
   }

     
   

   
}