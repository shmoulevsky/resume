<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index(){
        
        $resume = Resume::where(['user_id' => Auth::id()])->get(); 
        return view('mng.dashboard', ['resume' => $resume]);
        
    }
}
