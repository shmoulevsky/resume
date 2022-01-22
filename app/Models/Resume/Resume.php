<?php

namespace App\Models\Resume;

use App\Models\Comment;
use App\Models\File;
use App\Models\Form\Form;
use App\Traits\DateTimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test\Test;
use Carbon\Carbon;

class Resume extends Model
{
    use HasFactory;
    use DateTimeFormat;
    protected $table = 'resume';

    public function status()
    {
        return $this->hasOne('App\Models\Resume\ResumeStatus', 'id', 'resume_status_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function getDateAttribute(){
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function getFullNameAttribute(){
        return $this->last_name.' '.$this->name.' '.$this->second_name;
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tests_resume');
    }

}
