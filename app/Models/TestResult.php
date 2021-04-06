<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\QuestionAnswer;
use App\Models\TestResult;
use App\Models\TestsResultsAnswer;

class TestResult extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo('App\Models\Test', 'test_id');
    }

    public static function checkIfRight($questionId, $questionType, $answers){
        
        $result['points'] = 0;
        $result['is_right'] = false;

        if(($questionType == 1 || $questionType == 2) && $answers) {
            
            $rightAnswers = QuestionAnswer::where([['question_id','=', $questionId], ['points','>',0]])->get();
            $userAnswers = array_column($answers, 'id');
            $rightAnswersId = $rightAnswers->pluck('id')->toArray();

            foreach ($rightAnswers as $key => $rightAnswer) {
                if(in_array($rightAnswer->id, $userAnswers)){
                    $result['points'] += $rightAnswer->points; 
                }
            }

            if(count($rightAnswersId) == count($userAnswers)){
                $result['is_right'] = true;
            }
            
        }

        if($questionType == 3) {
           
        }

        if($questionType == 4) {
            
            $rightAnswers = QuestionAnswer::where([['question_id','=', $questionId]])->orderBy('number')->get()->pluck('id')->toArray();
            
            if(count($answers) > 0){

                usort($answers, function($a, $b){
                
                    if ($a['number'] == $b['number']) {
                        return 0;
                    }
    
                    return ($a['number'] < $b['number']) ? -1 : 1;
                });
    
                $userAnswers = array_column($answers, 'id');
                
                $userAnswers = array_map(function($item){
                    return $item = intval($item);
                }, $userAnswers);

                if($userAnswers === $rightAnswers){
                    $result['points'] = 100;
                    $result['is_right'] = true;
                }

            }
            

        }

        return $result;

    }

    public static function finishTest($testResultId, $finished_by = 1){

        
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

}
