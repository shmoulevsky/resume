<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $table = 'forms_fields';

    public function variants()
    {
        return $this->hasMany('App\Models\Form\FormFieldVariant', 'field_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Form\FormAnswer', 'field_id');
    }

    public function getRequiredClassAttribute()
    {
        return $this->is_required == 1 ? 'required' : '';
    }

}
