<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function change(Request $request)
    {

        $languages = array('ru','en');
        $locale = $request->locale;

        if(in_array($locale, $languages)){
            App::setLocale($locale);
            session()->put('locale', $locale);
            return ['status' =>'ok'];
        }

        throw new \Exception('There is no available locale');

    }
}
