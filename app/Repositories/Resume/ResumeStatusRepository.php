<?php
namespace App\Repositories\Resume;

use App\Models\Resume\ResumeStatus;

use App\Repositories\Interfaces\Resume\ResumeStatusRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class ResumeStatusRepository extends BaseRepository implements ResumeStatusRepositoryInterface{


   public function __construct(ResumeStatus $model)
   {
       parent::__construct($model);
   }

   public function getAll()
   {
       return ResumeStatus::orderBy('sort')->get();
   }



}
