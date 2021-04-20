<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ESh\Helper;

class Interview extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    
    public function getFormatDateTimeInterviewAttribute()     
     {               
        $arDate = Helper::convertDateTime($this->datetime, 'Y-m-d H:i'); 
        return '<span class="date-attr">'.$arDate[0].'</span>'.', '.'<span class="time-attr">'.$arDate[1].'</span>';       
     }

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume\Resume', 'resume_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

}
