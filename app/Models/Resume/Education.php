<?php

namespace App\Models\Resume;

use App\Traits\DateTimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    use DateTimeFormat;
    protected $table = 'education';

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

}
