<?php

namespace App\Services\Test;


use App\Models\Test\Question\Checkable;
use App\Models\Test\Question\Question;
use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;
use App\Models\Test\TestResume;
use App\Models\Test\TestResult;
use App\Models\Test\TestsResultsAnswer;

use App\DataTransferObjects\UserQuestionAnswerDTO;

class TestManager
{

    public function prepare(string $code, int $companyId): TestResult
    {
        $testResume = TestResume::where(['code' => $code, 'company_id' => $companyId])->first();

        if (empty($testResume)) {
            abort(404);
        }

        $test = Test::where(['id' => $testResume->test_id])->first();
        $questions = DB::table('tests_questions')->where('test_id', '=', $test->id)->pluck('question_id')->toArray();
        shuffle($questions);

        $testResult = testResult::where(['test_id' => $test->id, 'resume_id' => $testResume->resume_id])->first();

        if ($testResult == null) {

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

        return $testResult;
    }

    public function assign(array $arTestId, int $resumeId, int $companyId): array
    {
        $arUrl = [];

        foreach ($arTestId as $key => $testId) {

            $testResume = new TestResume();
            $testResume->code = rand(1000, 9999) . time() . rand(1000, 9999);
            $testResume->test_id = $testId;
            $testResume->resume_id = $resumeId;
            $testResume->company_id = $companyId;
            $testResume->save();
            $arUrl[] = config('APP_URL') . '/tests/info/' . $testResume->company_id . '/' . $testResume->code . '/';
        }

        return $arUrl;
    }

    public static function checkIfRight(int $questionId, $answers,Checkable $question): array
    {
        return $question->check($answers, $questionId);
    }

    public function getQuestions($testResultId)
    {
        $testResult = TestResult::where(['id' => $testResultId])->first();
        return unserialize($testResult->questions);
    }

    public function getQuestion(int $questionNumber,array $questions)
    {
        return  Question::where('id', $questions[$questionNumber - 1])->with('answers', function ($ans) {
            $ans->inRandomOrder();
        })->first();

    }

    public function getExistAnswers(int $testResultId, int $questionId)
    {
        return TestsResultsAnswer::where(['test_result_id' => $testResultId, 'question_id' => $questionId])->select('id','answer','answers_order')->first();
    }

    public function getTestResult($testId, $resumeId)
    {
        return TestResult::where(['test_id' => $testId, 'resume_id' => $resumeId])->orderBy('id', 'DESC')->first();
    }

    public function getConnectedResume(string $code,string $company)
    {
        return TestResume::where(['code' => $code, 'company_id' => $company])->first();
    }

    public function getTest(int $testId)
    {
        return Test::where(['id' => $testId])->first();
    }

    public function checkLastAnswers(int $testResultId, int $questionId, $questionType)
    {

        $answersExist = [];
        $lastItemOrder = 1;
        $lastItemLeft = 1;
        $lastItemRight = 1;

        $testAnswer = $this->getExistAnswers($testResultId, $questionId);

        if ($testAnswer) {

            $answersExistRaw = unserialize($testAnswer->answer);

            if ($answersExistRaw) {

                foreach ($answersExistRaw as $key => $value) {
                    $answersExist[$value['id']] = $value;
                }

                $answersExistId = array_column($answersExistRaw, 'id');

                if ($questionType == 3) {
                    $lastItemLeft = $lastItemRight = (intval(count($answersExistId) / 2)) + 1;
                }

                if ($questionType == 4) {
                    $lastItemOrder = count($answersExistId) + 1;
                }
            }

            //dd($testAnswer,$answersExistRaw);

            return [$answersExist, $answersExistId, $lastItemOrder, $lastItemLeft, $lastItemRight];
        }



    }

    public static function finishTest(int $testResultId, $finished_by = 1): testResult
    {


        $testResult = TestResult::where(['id' => $testResultId])->first();
        $test = Test::where(['id' => $testResult->test_id])->first();

        $userRightAnswers = TestsResultsAnswer::where(['test_result_id' => $testResultId, 'is_right' => 1])->count();
        $userPoints = TestsResultsAnswer::where(['test_result_id' => $testResultId, 'is_right' => 1])->sum('points');

        $percent = round((100 * $userRightAnswers) / $test->questions_count, 2);
        $testResult->percent = $percent;
        $testResult->points = $userPoints;
        $testResult->count_right = $userRightAnswers;
        $testResult->is_finished = 1;
        $testResult->finished_by = $finished_by;
        $testResult->save();
        return $testResult;
    }

    public static function saveAnswer(UserQuestionAnswerDTO $answer)
    {
        $testAnswer = TestsResultsAnswer::updateOrCreate([
            'test_id' => $answer->test_id,
            'test_result_id' => $answer->test_result_id,
            'resume_id' => $answer->resume_id,
            'question_id' => $answer->question_id,
        ], [
            'answer' => serialize($answer->answer),
            'company_id' => $answer->company_id,
            'user_id' => $answer->user_id,
            'points' => $answer->points,
            'is_right' => $answer->is_right,
            'answers_order' => $answer->answers_order,
            'is_answered' => $answer->is_answered,
        ]);

        return $testAnswer;
    }

    public static function updateAnswer(int $id, UserQuestionAnswerDTO $answer)
    {
        $testsResultsAnswer = TestsResultsAnswer::find($id);

        $testAnswer = $testsResultsAnswer->update([
            'answer' => serialize($answer->answer),
            'points' => $answer->points,
            'is_right' => $answer->is_right,
            'is_answered' => $answer->is_answered
        ]);

        return $testAnswer;
    }
}
