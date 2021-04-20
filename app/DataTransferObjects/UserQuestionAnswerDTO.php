<?php

namespace App\DataTransferObjects;

class UserQuestionAnswerDTO
{
    public $test_id;
    public $test_result_id;
    public $resume_id;
    public $question_id;
    public $company_id;
    public $user_id;
    public $points;
    public $is_right;
    public $is_answered;
    public $answers_order;
}
