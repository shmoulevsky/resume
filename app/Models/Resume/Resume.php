<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume\ResumeStatus;
use App\Models\Test\Test;
use Carbon\Carbon;

class Resume extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'resume';

    public function status()
    {
        return $this->hasOne('App\Models\Resume\ResumeStatus', 'id', 'resume_status_id');
    }

    public function form()
    {
        return $this->belongsTo('App\Models\Form\Form');
    }

    public function getDateAttribute(){
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function getFullNameAttribute(){
        return $this->last_name.' '.$this->name.' '.$this->second_name;
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function tests()
    {
        return $this->belongsToMany('App\Models\Test\Test', 'tests_resume');
    }

}
