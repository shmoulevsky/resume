<?php
namespace App\Repositories\Test;

use App\Models\Test\Test;

use App\Repositories\Interfaces\Test\TestRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class TestRepository extends BaseRepository implements TestRepositoryInterface{

    
   public function __construct(Test $model)
   {
       parent::__construct($model);
   }

   
   
}