<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Resume;

class Test extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    public function questions()
    {
        return $this->belongsToMany('App\Models\Question', 'tests_questions');
    }

    public function resume()
    {
        return $this->belongsToMany('App\Models\Resume', 'tests_resume');
    }
}
