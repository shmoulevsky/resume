<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Test\QuestionAnswer;
use App\Models\Test\TestResult;
use App\Models\Test\TestsResultsAnswer;

class TestResult extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo('App\Models\Test\Test', 'test_id');
    }
}
