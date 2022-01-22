<?php
namespace App\Services\Test;

use App\Repositories\Interfaces\Test\TestRepositoryInterface;
use App\Repositories\Interfaces\Test\TestResumeRepositoryInterface;
use App\Repositories\Interfaces\Test\TestResultRepositoryInterface;
use App\Repositories\Interfaces\FileRepositoryInterface;

use App\Models\Form\FormField;

class TestService{
          
   public function __construct(
       
       TestRepositoryInterface $testRepository,
       TestResultRepositoryInterface $testResultRepository,
       TestResumeRepositoryInterface $testResumeRepository,
       FileRepositoryInterface $fileRepository

       ) 
    {
 
       $this->testRepository = $testRepository;
       $this->testResultRepository = $testResultRepository;
       $this->testResumeRepository = $testResumeRepository;  
       $this->fileRepository = $fileRepository;
      
    }

  
   

   



   

}