<?php
namespace App\Repositories\Resume;

use App\Models\Resume\Interview;

use App\Repositories\Interfaces\Resume\InterviewRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;


class InterviewRepository extends BaseRepository implements InterviewRepositoryInterface{

   
   public function __construct(Interview $model)
   {
       parent::__construct($model);
   }

     
   

   
}