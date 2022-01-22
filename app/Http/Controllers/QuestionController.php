<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Test\Question;
use App\Models\Test\QuestionAnswer;

class QuestionController extends BaseController
{
    public function index()
    {

        $questions = Question::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->paginate(5);

        return view('mng.questions.list', compact('questions'));
    }

    public function show($id)
    {
        $question = Question::where(['user_id' => Auth::id(), 'id' => $id])->with(['questions'])->first();

        if (empty($question)) {
            abort(404);
        }

        return view('mng.questions.detail', compact('question'));
    }

    public function create()
    {
        return view('mng.questions.create');
    }

    public function edit($id)
    {
        $question = Question::where(['user_id' => Auth::id(), 'id' => $id])->with(['answers'])->first();
        return view('mng.questions.edit', compact('question'));
    }

    public function store(Request $request)
    {

        $userId = Auth::id();
        $companyId = Auth::user()->company->id;

        $arForm = $request->post('form');
        $arFields = $request->post('fields');

        $questionId = 0;

        if (isset($arForm['question-id'])) {$questionId = $arForm['question-id'];}

        //dd($arForm, $arFields);

        if ($arForm['points'] == '') {
            $arForm['points'] = 5;
        }
        if($questionId > 0){
            $question = Question::findOrFail($questionId);
        }else{
            $question = new Question();
        }

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
        if ($arForm['type'] == 1 || $arForm['type'] == 2) {
            foreach ($arFields as $key => &$arField) {

                if ($arField['is_right'] == 1) {
                    $countRight++;
                }
            }

            $points = intval(100 / $countRight);
        }


        unset($key);
        unset($arField);

        foreach ($arFields as $key => $arField) {

            if(strstr($key, 'new')){
                $answer = new QuestionAnswer();
            }else{
                $answer = QuestionAnswer::findOrFail($key);
            }

            $answer->answer = $arField['answer'];
            $answer->points = 0;
            $answer->number = 0;

            if ($arForm['type'] == 1 || $arForm['type'] == 2) {
                if ($arField['is_right'] == 1) {
                    $answer->points = $points;
                }
            }

            if ($arForm['type'] == 3) {
                $answer->number = $arField['pair'];
            }

            if ($arForm['type'] == 4) {
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

    public function update()
    {
    }
}
