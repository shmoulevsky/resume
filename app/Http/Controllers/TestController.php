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
        $testId = 0;
        if(isset($fields['test-id'])) {$testId = $fields['test-id'];}
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


    public function assign(Request $request)
    {

        $companyId = Auth::user()->company->id;

        $arTestId = $request->input('test_id');
        $resumeId = $request->input('resume_id');

        $arUrl = $this->testManager->assign($arTestId, $resumeId, $companyId);

        $data = ['status' => 'success', 'url' => $arUrl];

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
