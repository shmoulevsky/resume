<?php

namespace App\Services\Test;

use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;
use App\Models\Test\TestResume;
use App\Models\Test\TestResult;
use App\Models\Test\TestsResultsAnswer;
use App\Models\Test\Question;
use App\Models\Test\QuestionAnswer;

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

    public static function checkIfRight(int $questionId, int $questionType, $answers): array
    {

        $result['points'] = 0;
        $result['is_right'] = false;

        if (($questionType == 1 || $questionType == 2) && $answers) {

            $rightAnswers = QuestionAnswer::where([['question_id', '=', $questionId], ['points', '>', 0]])->get();
            $userAnswers = array_column($answers, 'id');
            $rightAnswersId = $rightAnswers->pluck('id')->toArray();

            foreach ($rightAnswers as $key => $rightAnswer) {
                if (in_array($rightAnswer->id, $userAnswers)) {
                    $result['points'] += $rightAnswer->points;
                }
            }

            if (count($rightAnswersId) == count($userAnswers)) {
                $result['is_right'] = true;
            }
        }

        if ($questionType == 3) {
        }

        if ($questionType == 4) {

            $rightAnswers = QuestionAnswer::where([['question_id', '=', $questionId]])->orderBy('number')->get()->pluck('id')->toArray();

            if (count($answers) > 0) {

                usort($answers, function ($a, $b) {

                    if ($a['number'] == $b['number']) {
                        return 0;
                    }

                    return ($a['number'] < $b['number']) ? -1 : 1;
                });

                $userAnswers = array_column($answers, 'id');

                $userAnswers = array_map(function ($item) {
                    return $item = intval($item);
                }, $userAnswers);

                if ($userAnswers === $rightAnswers) {
                    $result['points'] = 100;
                    $result['is_right'] = true;
                }
            }
        }

        return $result;
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
