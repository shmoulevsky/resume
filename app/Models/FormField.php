<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $table = 'forms_fields';

    public function variants()
    {
        return $this->hasMany('App\Models\FormFieldVariant', 'field_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\FormAnswer', 'field_id');
    }

    public function getRequiredClassAttribute()
    {
        return $this->is_required == 1 ? 'required' : '';
    }

}
