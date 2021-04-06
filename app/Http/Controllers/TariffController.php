<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Tariff;

class TariffController extends Controller
{
    public function showUser(){

        $tariff = Auth::user()->company->tariff()->first();
       
        return view('mng.tariffs.user', compact('tariff'));

    }
}
