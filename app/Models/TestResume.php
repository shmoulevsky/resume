<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResume extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'tests_resume';

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume', 'resume_id');
    }

    public function test()
    {
        return $this->belongsTo('App\Models\Test', 'test_id');
    }


}
