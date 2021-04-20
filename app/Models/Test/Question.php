<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test\Test;
use App\Models\Test\QuestionAnswer;

class Question extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    
    public function tests()
    {
        return $this->belongsToMany('App\Models\Test\Test', 'tests_questions');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Test\QuestionAnswer');
    }

    public function answersInRandomOrder()
    {
        return $this->hasMany(QuestionAnswer::class)->inRandomOrder();
    }

    public function getTypeNameAttribute(){
        $arType = ['Варианты ответа','Да/нет','Сопоставление','Хронология',''];
        return $arType[$this->type-1];
    }
}
