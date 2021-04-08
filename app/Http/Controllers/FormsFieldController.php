<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FormField;

class FormsFieldController
{
    public function delete($id ,Request $request){

        $user = Auth::user();
        
        $id = intval($request->id);
        $item = FormField::findOrFail(['id' => $id])->first();
                    
        $item->delete();
        

        return response()->json(['status' => 'deleted']);

    }
}
