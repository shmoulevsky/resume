<?php

namespace App\Models\Test;

use App\Models\Resume\Resume;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResume extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'tests_resume';

    public function resume()
    {
        return $this->belongsTo(Resume::class, 'resume_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }


}
