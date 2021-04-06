<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'url',
        'original_name',
        'name',
        'company_id',
        'user_id',
    ];

    public function resume(){

		return $this->belongsTo('App\Models\Resume');	
        
	}

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getSrcAttribute()
    {
        return $this->url.'/'.$this->name;
    }


}
