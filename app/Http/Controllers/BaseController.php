<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function delete($id ,Request $request){

        $user = Auth::user();
        $model = str_ireplace('Controllers','Models', static::class);
        $model = str_ireplace('Controller','', $model);
        $model = str_ireplace('Http\\','', $model);
        
        $item = $model::findOrFail(['id' => $id])->first();
                    
        $item->delete();
        $request->session()->flash('status', 'Запись удалена');

        return response()->json(['status' => 'deleted']);

    }
}
