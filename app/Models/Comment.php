<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory; 
    use \App\Traits\DateTimeFormat;

    public function user(){
		
		return $this->belongsTo('App\Models\User', 'user_id');
		
	}
	
	public function commentable()
    {
        return $this->morphTo();
    }
	
	public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
}
