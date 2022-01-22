<?php


namespace App\Models\Test\Question;


interface Checkable
{
    public function check($answers, $questionId);
}
