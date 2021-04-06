<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ResumeStatus;
use App\Models\Test;
use Carbon\Carbon;

class Resume extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'resume';

    public function status()
    {
        return $this->hasOne('App\Models\ResumeStatus', 'id', 'resume_status_id');
    }

    public function form()
    {
        return $this->belongsTo('App\Models\Form');
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
        return $this->belongsToMany('App\Models\Test', 'tests_resume');
    }

    public static function getDataForPDF($id){

        $data = [];

        $data['resume'] = Resume::where(['id' => $id])->first();

        $data['form'] = Form::where(['id' => $data['resume']->form_id])->first();
        $data['formFields'] = FormField::where(['form_id' => $data['resume']->form_id])->with(['answers' => function($query) use($id){
            $query->where('forms_answers.resume_id', '=', $id);
        }])->get();
        
        $data['resumeStatuses'] = ResumeStatus::all();
        $data['experience'] = Experience::where(['resume_id' => $data['resume']->id])->get();
        $data['education'] = Education::where(['resume_id' => $data['resume']->id])->get();

        $data['userPhoto'] = File::where(['id' => $data['resume']->photo_id])->first();

        return $data;

    }

}
