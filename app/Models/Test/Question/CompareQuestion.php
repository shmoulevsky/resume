<?php


namespace App\Models\Test\Question;


use App\Models\Test\Checkable;
use App\Models\Test\Question;

class CompareQuestion extends Question implements Checkable
{

    public function check($answers, $questionId)
    {
        return ['points' => 0, 'is_right' => false];
    }
}
