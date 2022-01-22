<?php
namespace App\Repositories\Resume;

use App\Models\Resume\Experience;

use App\Repositories\Interfaces\Resume\ExperienceRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;


class ExperienceRepository extends BaseRepository implements ExperienceRepositoryInterface{

   
   public function __construct(Experience $model)
   {
       parent::__construct($model);
   }

     
   

   
}