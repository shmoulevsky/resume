

            
           
                <div class="my-6">
                    @if($question->type == 1 || $question->type == 2)
                    <label class="text-xl block mb-3 my-2 block" for="">{{$question->question}}</label>
                        <div class="block">
                        @foreach($question->answers as $keyA => $answer)
                            <div class="mb-5">
                                <span data-id="{{$answer->id}}" class="answer-choice answer-clickable @if(in_array($answer->id, $answersExistId) == 1) active @endif"></span>
                                <span class=""><?=$keyA+1?>.<?=$answer->answer?></span>
                            </div>
                        @endforeach
                        </div>
                    </div>
                   @endif
                   @if($question->type == 3)
                    <label class="text-xl block mb-3 my-2 block" for="">{{$question->question}}</label>
                        <div class="flex">
                        <div class="compare-col">
                        @foreach($question->answers as $keyA => $answer)
                            <?if($answer->points == 1):?>
                            <div class="mb-5">
                                <span data-id="{{$answer->id}}" data-type="left" class="answer-compare answer-clickable {{ isset($answersExist[$answer->id]) ? 'active' : '' }}">{{ isset($answersExist[$answer->id]) ? $answersExist[$answer->id]['number'] : '' }}</span>
                                <span class=""><?=$keyA+1?>.<?=$answer->answer?></span>
                            </div>
                            <?endif?>
                        @endforeach
                        </div>
                        <div class="compare-col">
                        @foreach($question->answers as $keyA => $answer)
                            <?if($answer->points == 0):?>
                            <div class="mb-5">
                                <span data-id="{{$answer->id}}" data-type="right" class="answer-compare answer-clickable">{{ isset($answersExist[$answer->id]) ? $answersExist[$answer->id]['number'] : '' }}</span>
                                <span class=""><?=$keyA+1?>.<?=$answer->answer?></span>
                            </div>
                            <?endif?>
                        @endforeach
                        </div>
                        </div>
                    </div>
                   @endif
                   @if($question->type == 4)
                    <label class="text-xl block mb-3 my-2 block" for="">{{$question->question}}</label>
                        <div class="block">
                        @foreach($question->answers as $keyA => $answer)
                            <div class="mb-5">
                                <span data-id="{{$answer->id}}" class="answer-order answer-clickable {{ isset($answersExist[$answer->id]) ? 'active' : '' }}">
                                {{ isset($answersExist[$answer->id]) ? $answersExist[$answer->id]['number'] : '' }}
                                </span>
                                <span class=""><?=$keyA+1?>.<?=$answer->answer?></span>
                            </div>
                        @endforeach
                        </div>
                    </div>
                   @endif
                   <input type="hidden" id="qid" value="{{$question->id}}">
                   <input type="hidden" id="qtype" value="{{$question->type}}">
                   <input type="hidden" id="last-item-order" value="{{$lastItemOrder}}">
                   <input type="hidden" id="last-item-left" value="{{$lastItemLeft}}">
                   <input type="hidden" id="last-item-right" value="{{$lastItemRight}}">
                  
@php
 //echo "<pre>"; print_r($answersExist);echo "</pre>";
@endphp