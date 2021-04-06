<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Form extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;

    public function fields()
    {
        return $this->hasMany('App\Models\FormField', 'form_id');
    }

    public function resume()
    {
        return $this->hasMany('App\Models\Resume', 'form_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough('App\Models\FormAnswer', 'App\Models\FormField', 'id', 'form_id');
    }
}
