<?php

namespace App\Models\Test\Question;

use App\Models\Test\Question\SimpleQuestion;
use App\Models\Test\Question\ChronoQuestion;
use App\Traits\DateTimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model implements Checkable
{
    use HasFactory;
    use DateTimeFormat;

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tests_questions');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function answersInRandomOrder()
    {
        return $this->hasMany(QuestionAnswer::class)->inRandomOrder();
    }

    public function getTypeNameAttribute(){
        $arType = ['Варианты ответа','Да/нет','Сопоставление','Хронология',''];
        return $arType[$this->type-1];
    }

    public static function make($questionType) : Checkable
    {
        switch ($questionType)
        {
            case 1 : return new SimpleQuestion(); break;
            case 2 : return new SimpleQuestion(); break;
            case 3 : return new CompareQuestion(); break;
            case 4 : return new ChronoQuestion(); break;
            default : return  new Question();
        }

    }

    public function check($answers, $questionId)
    {
        // TODO: Implement check() method.
    }
}
