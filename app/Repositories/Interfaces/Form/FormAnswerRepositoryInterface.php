<?php

namespace App\Repositories\Interfaces\Form;

interface FormAnswerRepositoryInterface
{
    public function getPoints($formId, $resumeId);
}