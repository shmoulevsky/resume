<?php


namespace App\Models\Test\Question;


use App\Models\Test\Checkable;
use App\Models\Test\QuestionAnswer;

class ChronoQuestion extends Question implements Checkable
{

    public function check($answers, $questionId)
    {

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

        return $result;
    }
}
