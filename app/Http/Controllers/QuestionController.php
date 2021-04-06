<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionAnswer;

class QuestionController extends BaseController
{
    public function index(){

        $questions = Question::where(['user_id' => Auth::id()])->orderBy('id','desc')->paginate(5); 
        
        return view('mng.questions.list', compact('questions'));

    }

    public function show($id){
        $question = Question::where(['user_id' => Auth::id(), 'id' => $id])->with(['questions'])->first(); 

        if(empty($question)){
            abort(404);
        }

        return view('mng.questions.detail', compact('question'));
    }

    public function create(){

        return view('mng.questions.create');
    }

    public function edit(){

    }

    public function store(Request $request){

        $userId = Auth::id();
        $companyId = Auth::user()->company->id;

        $arForm = $request->post('form');
        $arFields = $request->post('fields');
        
        if($arForm['points'] == ''){
            $arForm['points'] = 5;
        }

        $question = new Question();
        $question->question = $arForm['question'];
        $question->description = $arForm['description'];
        $question->points = $arForm['points'];
        $question->is_active = 1;
        $question->type = $arForm['type'];
        $question->sort = 100;
        $question->user_id = $userId;
        $question->company_id = $companyId;
        $question->save();

        $countRight = 0;
        if($arForm['type'] == 1 || $arForm['type'] == 2){
            foreach($arFields as $key => &$arField){

                if($arField['is_right'] == 1){
                    $countRight++;
                }
            }

            $points = intval(100 / $countRight);
        }
        

        unset($key);
        unset($arField);

        

        foreach($arFields as $key => $arField){

            $answer = new QuestionAnswer();
            $answer->answer = $arField['answer'];
            $answer->points = 0;
            $answer->number = 0;

            if($arForm['type'] == 1 || $arForm['type'] == 2){    
                if($arField['is_right'] == 1){
                    $answer->points = $points;
                }
            }

            if($arForm['type'] == 3){    
                $answer->number = $arField['pair'];   
            }

            if($arForm['type'] == 4){    
                $answer->number = $arField['chrono'];   
            }
            
            $answer->sort = 100;
            $answer->is_active = 1;
            $answer->question_id = $question->id;
            $answer->company_id = $companyId;
            $answer->save();

        }

        return response()->json([
            'id' => $question->id,
            'status' => 'success'
        ]); 

    }

    public function update(){

    }

}
