<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Resume\ResumeRepository;
use App\Repositories\Interfaces\Resume\ResumeRepositoryInterface;

use App\Repositories\Resume\ExperienceRepository;
use App\Repositories\Interfaces\Resume\ExperienceRepositoryInterface;

use App\Repositories\Resume\EducationRepository;
use App\Repositories\Interfaces\Resume\EducationRepositoryInterface;

use App\Repositories\Resume\InterviewRepository;
use App\Repositories\Interfaces\Resume\InterviewRepositoryInterface;

use App\Repositories\Resume\ResumeStatusRepository;
use App\Repositories\Interfaces\Resume\ResumeStatusRepositoryInterface;

use App\Repositories\FileRepository;
use App\Repositories\Interfaces\FileRepositoryInterface;

use App\Repositories\Form\FormRepository;
use App\Repositories\Interfaces\Form\FormRepositoryInterface;

use App\Repositories\Form\FormFieldRepository;
use App\Repositories\Interfaces\Form\FormFieldRepositoryInterface;

use App\Repositories\Form\FormFieldVariantRepository;
use App\Repositories\Interfaces\Form\FormFieldVariantRepositoryInterface;

use App\Repositories\Form\FormAnswerRepository;
use App\Repositories\Interfaces\Form\FormAnswerRepositoryInterface;

use App\Repositories\Test\TestRepository;
use App\Repositories\Interfaces\Test\TestRepositoryInterface;

use App\Repositories\Test\TestResultRepository;
use App\Repositories\Interfaces\Test\TestResultRepositoryInterface;

use App\Repositories\Test\TestResumeRepository;
use App\Repositories\Interfaces\Test\TestResumeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ResumeRepositoryInterface::class, 
            ResumeRepository::class
        );

        $this->app->bind(
            ExperienceRepositoryInterface::class, 
            ExperienceRepository::class
        );

        $this->app->bind(
            EducationRepositoryInterface::class, 
            EducationRepository::class
        );

        $this->app->bind(
            ResumeStatusRepositoryInterface::class, 
            ResumeStatusRepository::class
        );

        $this->app->bind(
            FileRepositoryInterface::class, 
            FileRepository::class
        ); 

        $this->app->bind(
            FormRepositoryInterface::class, 
            FormRepository::class
        );

        $this->app->bind(
            FormFieldRepositoryInterface::class, 
            FormFieldRepository::class
        );

        $this->app->bind(
            FormFieldVariantRepositoryInterface::class, 
            FormFieldVariantRepository::class
        );

        $this->app->bind(
            FormAnswerRepositoryInterface::class, 
            FormAnswerRepository::class
        );

        $this->app->bind(
            TestRepositoryInterface::class, 
            TestRepository::class
        );

        $this->app->bind(
            TestResultRepositoryInterface::class, 
            TestResultRepository::class
        );

        $this->app->bind(
            TestResumeRepositoryInterface::class, 
            TestResumeRepository::class
        );

        $this->app->bind(
            InterviewRepositoryInterface::class, 
            InterviewRepository::class
        );
        
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
