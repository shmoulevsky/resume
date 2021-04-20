<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test\Question;
use App\Models\Resume\Resume;

class Test extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    public function questions()
    {
        return $this->belongsToMany('App\Models\Test\Question', 'tests_questions');
    }

    public function resume()
    {
        return $this->belongsToMany('App\Models\Resume\Resume', 'tests_resume');
    }
}
