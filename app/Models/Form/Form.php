<?php

namespace App\Models\Form;

use App\Models\Resume\Resume;
use App\Traits\DateTimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Form extends Model
{
    use HasFactory;
    use DateTimeFormat;

    public function fields()
    {
        return $this->hasMany(FormField::class, 'form_id');
    }

    public function resume()
    {
        return $this->hasMany(Resume::class, 'form_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(FormAnswer::class, FormField::class, 'id', 'form_id');
    }
}
