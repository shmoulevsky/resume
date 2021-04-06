<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    use \App\Traits\DateTimeFormat;
    protected $table = 'experience';

    public function resume()
    {
        return $this->belongsTo('App\Models\Resume');
    }

}
