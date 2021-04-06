<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['name','code','is_active','sort','user_id','tariff_id'];
    use HasFactory;

    public function tariff()
    {
        return $this->hasOne('App\Models\Tariff', 'id', 'tariff_id');
    }

}
