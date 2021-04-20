<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Form extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;

    public function fields()
    {
        return $this->hasMany('App\Models\Form\FormField', 'form_id');
    }

    public function resume()
    {
        return $this->hasMany('App\Models\Resume\Resume', 'form_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough('App\Models\Form\FormAnswer', 'App\Models\Form\FormField', 'id', 'form_id');
    }
}
