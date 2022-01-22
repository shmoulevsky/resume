<?php
namespace App\Repositories\Test;

use App\Models\Test\TestResult;

use App\Repositories\Interfaces\Test\TestResultRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class TestResultRepository extends BaseRepository implements TestResultRepositoryInterface{

    
   public function __construct(TestResult $model)
   {
       parent::__construct($model);
   }

   
   
}