<?php


namespace App\Http\Controllers\User;


use App\DataTransferObjects\UserQuestionAnswerDTO;
use App\Mail\TestFinished;
use App\Models\Company;
use App\Models\Resume\Resume;
use App\Models\Test\Question\Question;
use App\Models\Test\QuestionAnswer;
use App\Models\Test\Test;
use App\Models\Test\TestResult;
use App\Models\Test\TestResume;
use App\Models\Test\TestsResultsAnswer;
use App\Models\User;
use App\Services\Test\TestManager;
use App\Services\Test\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserTestController
{
    public function __construct(
        TestService $testService,
        TestManager $testManager
    ) {
        $this->testService = $testService;
        $this->testManager = $testManager;
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

    public function show(Request $request)
    {

        $view = 'public.tests.show';

        $questionId = null;
        $lastItemOrder = 1;
        $lastItemLeft = 1;
        $lastItemRight = 1;
        $questionNum = 1;

        $code = $request->code;
        $company = $request->company;

        $testResume = $this->testManager->getConnectedResume($code, $company);
        $test = $this->testManager->getTest($testResume->test_id);
        $testResult = $this->testManager->getTestResult($test->id, $testResume->resume_id);

        $questions = unserialize($testResult->questions);
        $countQuestions = count($questions);
        $question = $this->testManager->getQuestion($questionNum, $questions);

        list($answersExist, $answersExistId, $lastItemOrder, $lastItemLeft, $lastItemRight) = $this->testManager->checkLastAnswers($testResult->id, $question->id,$question->type);
        $arCompact = ['question', 'answersExist', 'answersExistId', 'test', 'testResult', 'countQuestions', 'lastItemOrder', 'lastItemLeft', 'lastItemRight'];

        return view($view, compact($arCompact));
    }

    public function showQuestion(Request $request)
    {

        /**proccess answer */
        $questionId = $request->input('question');
        $questionType = $request->input('questionType');

        $questionNum = $request->input('number');
        $testResultId = $request->input('test');
        $answers = $request->input('answers');

        $testResult = TestResult::where(['id' => $testResultId])->first();

        $questions = unserialize($testResult->questions);
        $question = $this->testManager->getQuestion($questionNum, $questions);

        /**procees last answers */
        if ($questionId && $answers) {

            $result = $this->testManager->checkIfRight($questionId, $answers, Question::make($questionType));

            $userQuestionAnswer = new UserQuestionAnswerDTO();
            $userQuestionAnswer->answer = $answers;
            $userQuestionAnswer->points = $result['points'];
            $userQuestionAnswer->is_right = $result['is_right'];
            $userQuestionAnswer->is_answered = 1;

            $testsResultsAnswer = TestsResultsAnswer::where(['test_result_id' => $testResult->id, 'question_id' => $questionId])->first();

            $testAnswer = $this->testManager->updateAnswer($testsResultsAnswer->id, $userQuestionAnswer);
        }

        list($answersExist, $answersExistId, $lastItemOrder, $lastItemLeft, $lastItemRight) = $this->testManager->checkLastAnswers($testResult->id, $question->id,$question->type);

        //$this->testManager->getExistAnswers($testResultId, $questionId);

        $arCompact = ['question', 'answersExist', 'answersExistId', 'lastItemOrder', 'lastItemLeft', 'lastItemRight'];
        return view('public.tests.question', compact($arCompact));
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


    public function handleAnswer()
    {

        $arCompact = ['question', 'answersExist', 'answersExistId', 'test', 'testResult', 'countQuestions', 'lastItemOrder', 'lastItemLeft', 'lastItemRight'];
    }

}
