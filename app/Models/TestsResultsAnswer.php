<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsResultsAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['test_id', 'test_result_id', 'resume_id', 'question_id','user_id','company_id','answer','points','is_right','is_answered'];
}
