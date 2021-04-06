<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\TestFinished;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\User;
use App\Models\TestResume;
use App\Models\Resume;
use App\Models\Question;
use App\Models\Company;
use App\Models\TestResult;
use App\Models\TestsResultsAnswer;

class TestController extends BaseController
{
    public function index(){

        $tests = Test::where(['user_id' => Auth::id()])->orderBy('id','desc')->paginate(5); 
        
        return view('mng.tests.list', compact('tests'));

    }

    public function show($id){
        
        $test = Test::where(['user_id' => Auth::id(), 'id' => $id])->with(['questions'])->first(); 

        if(empty($test)){
            abort(404);
        }

        return view('mng.tests.detail', compact('test'));
    }

    public function getList(Request $request){
        
        $tests = Test::where(['user_id' => Auth::id()])->with(['questions'])->get(); 

        if(empty($tests)){
            abort(404);
        }

        return view('mng.tests.get-list', compact('tests'));
    }

    public function create(){
    
        $questions = Question::where(['user_id' => Auth::id()])->orderBy('id','desc')->get();
        return view('mng.tests.create', compact('questions'));
    }

    public function edit(){

    }

    public function store(Request $request){

        $fields = $request->post('fields');
        $user = Auth::user();
        
        $test = new Test();
        $test->name = $fields['name'];
        $test->questions_count = 10;
        $test->type = 1;
        $test->is_active = 1;
        $test->description = $fields['description'];
        $test->user_id = $user->id;
        $test->company_id = $user->company->id;
        $test->save();

        foreach ($fields as $key => $value) {
            if(strstr($key,'question') && $value == 'true'){
                $arQuestions[] = str_ireplace('question-','', $key);
            }
        }

        
        $test->questions()->attach($arQuestions);

        $data = ['status' => 'success'];

        return response()->json($data, 200); 

    }

    public function update(){

    }

    public function showTestInfo(Request $request, $companyId, $code){
        
        $isPassed = false;
        $testResume = TestResume::where(['code' => $code, 'company_id' => $companyId])->first();
        $company = Company::where(['id' => $companyId])->first();
        
        if(empty($testResume) || empty($company)){
            abort(404);
        }

        $test = Test::where(['id' => $testResume->test_id])->first();
        $testResult = testResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->first();

        if($testResult){
            $isPassed = true;
        }
    
        return view('public.tests.info', compact(['test','testResume','company','companyId','code','isPassed']));
    }

    public function prepareTest(Request $request){
        
        
        $code = $request->input('code');
        $companyId = $request->input('companyId');
        
        $testResume = TestResume::where(['code' => $code, 'company_id' => $companyId])->first();

        if(empty($testResume)){
            abort(404);
        }
        
        $test = Test::where(['id' => $testResume->test_id])->first();
        $questions = DB::table('tests_questions')->where('test_id','=',$test->id)->pluck('question_id')->toArray();
        shuffle($questions);
        
        $testResult = testResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->first();

        if($testResult == null){

            $testResult = new TestResult();
            $testResult->questions = serialize($questions); 	
            $testResult->points = 0;
            $testResult->timer = 0; 	
            $testResult->count = count($questions); 	
            $testResult->count_right = 0;
            $testResult->finished_by = 0;
            $testResult->is_finished = 0; 	
            $testResult->percent = 0; 	
            $testResult->company_id = $companyId;
            $testResult->user_id = $test->user_id; 	
            $testResult->resume_id = $testResume->resume_id;
            $testResult->test_id = $testResume->test_id; 
            $testResult->save();

        }

        

        $data = ['status' => 'success'];

        return response()->json($data, 200);
        
    }
    
    public function publicShow(Request $request){
        
        $view = 'public.tests.show';
        $questionId = null;
        $lastItemOrder = 1;
        $lastItemLeft = 1;
        $lastItemRight = 1;

        if($request->ajax()){
            
            $view = 'public.tests.question';
            /**proccess answer */
            $questionId = $request->input('question');
            $questionType = $request->input('questionType');
            
            $questionNum = $request->input('number');
            $testResultId = $request->input('test');
            $answers = $request->input('answers');

            $testResult = TestResult::where(['id' => $testResultId])->first();

            if($questionId){

                $result = TestResult::checkIfRight($questionId, $questionType, $answers);

                $testAnswer = TestsResultsAnswer::updateOrCreate([
                    'test_id' => $testResult->test_id,
                    'test_result_id' => $testResult->id,
                    'resume_id' => $testResult->resume_id,
                    'question_id' => $questionId,
                ],[
                    'answer' => serialize($answers),
                    'company_id' => $testResult->company_id,
                    'user_id' => $testResult->user_id,
                    'points' => $result['points'],
                    'is_right' => $result['is_right'],
                    'is_answered' => 1,
                ]);

                
                //dump($result);
            }

            $arCompact = ['question','answersExist','answersExistId','lastItemOrder','lastItemLeft','lastItemRight'];

        }else{

            $code = $request->code;
            $company = $request->company;

            $testResume = TestResume::where(['code' => $code, 'company_id' => $company])->first();

            if(empty($testResume)){
                abort(404);
            }

            $test = Test::where(['id' => $testResume->test_id])->first();

            if(empty($test)){
                abort(404);
            }
        
            $testResult = TestResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->orderBy('id', 'DESC')->first();

            $questions = unserialize($testResult->questions);
            $countQuestions = count($questions);
            
            $questionNum = 1;

            $arCompact = ['question','answersExist','answersExistId','test','testResult','countQuestions','lastItemOrder','lastItemLeft','lastItemRight'];
        }

        
        if(empty($testResult)){
            abort(404);
        }
           
        
        $questions = unserialize($testResult->questions);
        $question = Question::where('id', $questions[$questionNum-1])->with('answers', function($ans){
            $ans->inRandomOrder();
        })->first();
        
        //$question = DB::table('questions')->join('question_answers', 'questions.id', '=', 'question_answers.question_id')->select('questions.*', 'question_answers.*')->where('questions.id', $questions[$questionNum-1])->groupBy('questions.id')->get();

        //dd($question);

        $answersExistRaw = [];
        $answersExist = [];
        $answersExistId = [];
  
              
        $testAnswer = TestsResultsAnswer::where([
            'test_id' => $testResult->test_id,
            'test_result_id' => $testResult->id,
            'resume_id' => $testResult->resume_id,
            'question_id' => $question->id,
        ])->first();
        
        if($testAnswer){
            
            $answersExistRaw = unserialize($testAnswer->answer);
            
            if($answersExistRaw){
                
                foreach ($answersExistRaw as $key => $value) {
                    $answersExist[$value['id']] = $value;
                }

                $answersExistId = array_column($answersExistRaw,'id');

                if($question->type == 3) {
                    $lastItemLeft = $lastItemRight = (intval(count($answersExistId) / 2)) + 1;
                }

                if($question->type == 4) {
                    $lastItemOrder = count($answersExistId) + 1;
                }

            }
            
        }
         
        return view($view, compact($arCompact));
    }

    public function assign(Request $request){
        
        $user = Auth::user();

        $arTestId = $request->input('test_id');

        foreach ($arTestId as $key => $testId) {

            $testResume = new TestResume(); 
            $testResume->code = rand(1000,9999).time().rand(1000,9999);
            $testResume->test_id = $testId;
            $testResume->resume_id = $request->input('resume_id');
            $testResume->company_id = $user->company->id;
            $testResume->save();
            $arUrl[] = config('APP_URL').'/tests/info/'.$testResume->company_id.'/'.$testResume->code.'/'; 
        }
        
        $data = ['status' => 'success', 'url' => $arUrl];

        return response()->json($data, 200);
        
    }

    public function finish(Request $request){

        $testResultId = $request->input('test_result_id');
        $testResult = TestResult::finishTest($testResultId, 1);
        $data = ['status' => 'success'];
        
        $test = Test::findOrFail($testResult->test_id);
        $user = User::findOrFail($test->user_id);
        $resume = Resume::findOrFail($testResult->resume_id);
        
        $url = config('APP_URL').route('resume.detail', $resume->id);
        Mail::to($user)->send(new TestFinished($resume, $test, $testResult, $url));

        return response()->json($data, 200);
    }
}
