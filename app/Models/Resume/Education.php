<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'education';

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume\Resume');
    }

}
