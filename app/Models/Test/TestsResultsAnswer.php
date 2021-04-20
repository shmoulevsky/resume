<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsResultsAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['test_id', 'test_result_id', 'resume_id', 'question_id', 'user_id', 'company_id', 'answer', 'answers_order', 'points', 'is_right', 'is_answered'];
}
