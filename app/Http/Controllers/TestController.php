<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\TestFinished;

use Illuminate\Http\Request;
use App\Models\Test\Test;
use App\Models\User;
use App\Models\Test\TestResume;
use App\Models\Resume\Resume;
use App\Models\Test\Question;
use App\Models\Test\QuestionAnswer;
use App\Models\Test\TestQuestion;

use App\Models\Company;
use App\Models\Test\TestResult;
use App\Models\Test\TestsResultsAnswer;

use App\Services\Test\TestService;
use App\Services\Test\TestManager;

use App\DataTransferObjects\UserQuestionAnswerDTO;

class TestController extends BaseController
{

    public function __construct(
        TestService $testService,
        TestManager $testManager
    ) {
        $this->testService = $testService;
        $this->testManager = $testManager;
    }

    public function index()
    {

        $tests = Test::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->paginate(5);

        return view('mng.tests.list', compact('tests'));
    }

    public function show($id)
    {

        $test = Test::where(['user_id' => Auth::id(), 'id' => $id])->with(['questions'])->first();

        if (empty($test)) {
            abort(404);
        }

        return view('mng.tests.detail', compact('test'));
    }

    public function getList(Request $request)
    {

        $tests = Test::where(['user_id' => Auth::id()])->with(['questions'])->get();

        if (empty($tests)) {
            abort(404);
        }

        return view('mng.tests.get-list', compact('tests'));
    }

    public function create()
    {

        $questions = Question::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->get();
        return view('mng.tests.create', compact('questions'));
    }

    public function edit(int $id)
    {

        $test = Test::where(['id' => $id])->first();
        $questionsId = TestQuestion::where('test_id', $id)->get()->pluck('question_id')->toArray();
        $questions = Question::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->get();



        $questions->map(function ($question) use ($questionsId) {
            return in_array($question->id, $questionsId) ? $question->is_check = true : $question->is_check = false;
        });

        return view('mng.tests.edit', compact('test', 'questions'));
    }

    public function store(Request $request)
    {

        $fields = $request->post('fields');
        $testId = $fields['test-id'];
        $user = Auth::user();

        foreach ($fields as $key => $value) {
            if (strstr($key, 'question') && $value == 'true') {
                $arQuestions[] = str_ireplace('question-', '', $key);
            }
        }

        if ($testId > 0) {

            $test = Test::findOrFail($testId);
            $test->name = $fields['name'];
            $test->description = $fields['description'];
            $test->questions()->sync($arQuestions);
        } else {

            $test = new Test();
            $test->name = $fields['name'];
            $test->questions_count = 10;
            $test->type = 1;
            $test->is_active = 1;
            $test->description = $fields['description'];
            $test->user_id = $user->id;
            $test->company_id = $user->company->id;
            $test->save();
            $test->questions()->attach($arQuestions);
        }

        $data = ['status' => 'success'];

        return response()->json($data, 200);
    }


    public function showTestInfo(Request $request, $companyId, $code)
    {

        $isPassed = false;
        $testResume = TestResume::where(['code' => $code, 'company_id' => $companyId])->first();
        $company = Company::where(['id' => $companyId])->first();

        if (empty($testResume) || empty($company)) {
            abort(404);
        }

        $test = Test::where(['id' => $testResume->test_id])->first();
        $testResult = testResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->first();

        if ($testResult) {
            $isPassed = true;
        }

        return view('public.tests.info', compact(['test', 'testResume', 'company', 'companyId', 'code', 'isPassed']));
    }

    public function prepareTest(Request $request)
    {


        $code = $request->input('code');
        $companyId = $request->input('companyId');

        $testResult = $this->testManager->prepare($code, $companyId);

        if (!$testResult) {
            abort(403);
        }

        $data = ['status' => 'success'];

        return response()->json($data, 200);
    }

    public function publicShow(Request $request)
    {

        $view = 'public.tests.show';
        $questionId = null;
        $lastItemOrder = 1;
        $lastItemLeft = 1;
        $lastItemRight = 1;

        if ($request->ajax()) {

            $view = 'public.tests.question';
            /**proccess answer */
            $questionId = $request->input('question');
            $questionType = $request->input('questionType');

            $questionNum = $request->input('number');
            $testResultId = $request->input('test');
            $answers = $request->input('answers');

            $testResult = TestResult::where(['id' => $testResultId])->first();

            /**procees last answers */
            if ($questionId && $answers) {

                $result = $this->testManager->checkIfRight($questionId, $questionType, $answers);

                $userQuestionAnswer = new UserQuestionAnswerDTO();
                $userQuestionAnswer->answer = $answers;
                $userQuestionAnswer->points = $result['points'];
                $userQuestionAnswer->is_right = $result['is_right'];
                $userQuestionAnswer->is_answered = 1;

                $testsResultsAnswer = TestsResultsAnswer::where(['test_result_id' => $testResult->id, 'question_id' => $questionId])->first();

                $testAnswer = $this->testManager->updateAnswer($testsResultsAnswer->id, $userQuestionAnswer);
            }

            $arCompact = ['question', 'answersExist', 'answersExistId', 'lastItemOrder', 'lastItemLeft', 'lastItemRight'];
        } else {

            $code = $request->code;
            $company = $request->company;

            $testResume = TestResume::where(['code' => $code, 'company_id' => $company])->first();

            if (empty($testResume)) {
                abort(404);
            }

            $test = Test::where(['id' => $testResume->test_id])->first();

            if (empty($test)) {
                abort(404);
            }

            $testResult = TestResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->orderBy('id', 'DESC')->first();

            $questions = unserialize($testResult->questions);
            $countQuestions = count($questions);

            $questionNum = 1;

            $arCompact = ['question', 'answersExist', 'answersExistId', 'test', 'testResult', 'countQuestions', 'lastItemOrder', 'lastItemLeft', 'lastItemRight'];
        }


        if (empty($testResult)) {
            abort(404);
        }


        $questions = unserialize($testResult->questions);
        $question = Question::where('id', $questions[$questionNum - 1])->with('answers', function ($ans) {
            $ans->inRandomOrder();
        })->first();

        /**
         * if question type compare then we need to special sorting of answers
         */
        if ($question->type == 3) {

            $question = Question::where('id', $questions[$questionNum - 1])->first();
            $answers =  QuestionAnswer::where('question_id', $question->id)->get()->groupBy('sort');

            $answersLeft = $answers[0]->shuffle(); 
            $answersRight = $answers[1]->shuffle(); 
            
            $arCompact[] = 'answersLeft';
            $arCompact[] = 'answersRight';
           

        } else {
            $question = Question::where('id', $questions[$questionNum - 1])->with('answers', function ($query) {
                $query->inRandomOrder();
            })->first();
        }

        $testsResultsAnswer = TestsResultsAnswer::where(['test_result_id' => $testResult->id, 'question_id' => $question->id])->select('id', 'answers_order')->first();

        if (!$testsResultsAnswer) {

            if ($question->type == 3) {
                
                $answersOrder = $answersLeft->pluck('id')->toArray();
                $answersOrder = array_merge($answersOrder, $answersRight->pluck('id')->toArray());
                
            }else{
                $answersOrder = $question->answers->pluck('id')->toArray();
            }
            
            $answersOrder = implode(',', $answersOrder);

            $userQuestionAnswer = new UserQuestionAnswerDTO();
            $userQuestionAnswer->test_id = $testResult->test_id;
            $userQuestionAnswer->test_result_id = $testResult->id;
            $userQuestionAnswer->resume_id = $testResult->resume_id;
            $userQuestionAnswer->question_id = $question->id;
            $userQuestionAnswer->answer = '';
            $userQuestionAnswer->company_id = $testResult->company_id;
            $userQuestionAnswer->user_id = $testResult->user_id;
            $userQuestionAnswer->points = 0;
            $userQuestionAnswer->is_right = 0;
            $userQuestionAnswer->is_answered = 0;
            $userQuestionAnswer->answers_order = $answersOrder;
            $testAnswer = $this->testManager->saveAnswer($userQuestionAnswer);
        } else {

            $answersOrder = explode(',', $testsResultsAnswer->answers_order);

            if ($question->type == 3) {
                
                $answersLeft = $answersLeft->sortBy(function ($model) use ($answersOrder) {
                    return array_search($model->getKey(), $answersOrder);
                });

                $answersRight = $answersRight->sortBy(function ($model) use ($answersOrder) {
                    return array_search($model->getKey(), $answersOrder);
                });

                
            }else{
                
                $question->answers = $question->answers->sortBy(function ($model) use ($answersOrder) {
                    return array_search($model->getKey(), $answersOrder);
                });
                
            }

            
        }


        $answersExistRaw = [];
        $answersExist = [];
        $answersExistId = [];


        $testAnswer = TestsResultsAnswer::where([
            'test_id' => $testResult->test_id,
            'test_result_id' => $testResult->id,
            'resume_id' => $testResult->resume_id,
            'question_id' => $question->id,
        ])->first();

        if ($testAnswer) {

            $answersExistRaw = unserialize($testAnswer->answer);
           
            if ($answersExistRaw) {

                foreach ($answersExistRaw as $key => $value) {
                    $answersExist[$value['id']] = $value;
                }

                $answersExistId = array_column($answersExistRaw, 'id');

                if ($question->type == 3) {
                    $lastItemLeft = $lastItemRight = (intval(count($answersExistId) / 2)) + 1;
                }

                if ($question->type == 4) {
                    $lastItemOrder = count($answersExistId) + 1;
                }
            }

            //dd($answersExist);
        }

        return view($view, compact($arCompact));
    }

    public function assign(Request $request)
    {

        $companyId = Auth::user()->company->id;

        $arTestId = $request->input('test_id');
        $resumeId = $request->input('resume_id');

        $arUrl = $this->testManager->assign($arTestId, $resumeId, $companyId);

        $data = ['status' => 'success', 'url' => $arUrl];

        return response()->json($data, 200);
    }

    public function finish(Request $request)
    {

        $testResultId = $request->input('test_result_id');
        $testResult = $this->testManager->finishTest($testResultId, 1);
        $data = ['status' => 'success'];

        $test = Test::findOrFail($testResult->test_id);
        $user = User::findOrFail($test->user_id);
        $resume = Resume::findOrFail($testResult->resume_id);

        $url = config('app.url') . route('resume.detail', $resume->id);
        Mail::to($user)->send(new TestFinished($resume, $test, $testResult, $url));

        return response()->json($data, 200);
    }

    public function delete($id, Request $request)
    {

        $item = $this->testService->testRepository->getById($id);
        $item->delete();
        $request->session()->flash('status', 'Запись удалена');

        return response()->json(['status' => 'deleted']);
    }
}
