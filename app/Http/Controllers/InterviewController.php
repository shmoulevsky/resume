<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Resume\Interview;
use App\Models\Form\Form;
use App\Models\Resume\Resume;



class InterviewController extends BaseController
{
    public function index(){

        $interviews = Interview::where(['user_id' => Auth::id()])->with(['resume' ])->orderBy('id','desc')->paginate(5); 
        
        return view('mng.interviews.list', ['interviews' => $interviews]);

    }

    public function show($id){
        $interview = Interview::where(['user_id' => Auth::id(), 'id' => $id])->with(['resume'])->first(); 
        //dd($interview);
        if(empty($interview)){
            abort(404);
        }

        $form = Form::where(['user_id' => Auth::id(), 'id' => $interview->resume->form_id])->first(); 
       
        return view('mng.interviews.detail', ['interview' => $interview, 'form' => $form]);
    }

    public function create(){

        $forms = Form::where(['user_id' => Auth::id()])->get(); 
        $resume = Resume::where(['company_id' => Auth::user()->company->id])->get(); 

        return view('mng.interviews.create', compact('forms', 'resume'));
    }

    public function createAjax(){
        return view('mng.interviews.ajax.create');
    }

    public function edit(){

    }

    public function store(Request $request){

        $fields = $request->post('fields');
        $user = Auth::user();
        
        $resumeId = $fields['resume-id'];
        $date = \DateTime::createFromFormat('d.m.Y H:i', $fields['datetime']);
        
        $interview = new Interview();
        $interview->company_id = $user->company->id;
        $interview->user_id = $user->id;
        $interview->resume_id = $resumeId;
        $interview->comment = '';
        $interview->place = '';
        $interview->datetime = $date->format('Y-m-d H:i:s');
        $interview->save();

        $data = ['status' => 'success'];

        return response()->json($data, 200); 

    }

    public function update(){

    }

}
