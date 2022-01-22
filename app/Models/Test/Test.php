<?php

namespace App\Models\Test;

use App\Models\Resume\Resume;
use App\Models\Test\Question\Question;
use App\Traits\DateTimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
    use HasFactory;
    use DateTimeFormat;
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'tests_questions');
    }

    public function resume()
    {
        return $this->belongsToMany(Resume::class, 'tests_resume');
    }
}
