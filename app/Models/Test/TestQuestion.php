<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TestQuestion extends Model
{
    use HasFactory;
    protected $table = 'tests_questions';
}
