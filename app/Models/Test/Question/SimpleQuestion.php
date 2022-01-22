<?php


namespace App\Models\Test\Question;


class SimpleQuestion extends Question implements Checkable
{

    public function check($answers, $questionId)
    {
        $result = ['points' => 0, 'is_right' => false];

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

        return $result;
    }
}
