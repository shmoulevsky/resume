<?php
namespace App\Repositories\Form;

use App\Models\Form\FormFieldVariant;

use App\Repositories\Interfaces\Form\FormFieldVariantRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;


class FormFieldVariantRepository extends BaseRepository implements FormFieldVariantRepositoryInterface{

   
   public function __construct(FormFieldVariant $model)
   {
       parent::__construct($model);
   }

     
   

   
}