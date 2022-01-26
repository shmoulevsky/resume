@extends('mng.master')
@section('title', __('question-create.Title'))
@section('content')
<div class="questions-inner">
            <h3>{{ __('question-create.Question_type')}}:</h3>
            <ul class="tab-wrap question-type-tab-title">
                <li data-type="1" class="active">{{ __('question-create.Variants')}}</li>
                <li data-type="2">{{ __('question-create.Yes_no')}}</li>
                <li data-type="3">{{ __('question-create.Comparison')}}</li>
                <li data-type="4">{{ __('question-create.Chrono')}}</li>
            </ul>
            <form class="styled-form w-6/12" >
                @csrf
                <div id="question-form" class="fields-wrap relative">

                    <div class="mb-5">
                        <label for="">{{ __('question-create.Question')}}:</label>
                        <textarea data-name="question" class="form-main-field" name="question" type="text" value=""></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">{{ __('question-create.Description')}}:</label>
                        <textarea data-name="description" class="form-main-field" name="question" type="text" value=""></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">{{ __('question-create.Points')}}:</label>
                        <input data-name="points" class="form-main-field" name="points" type="text" value=""/>
                    </div>
                    <div class="question-type-1 question-type-tab active">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">{{ __('question-create.Answer')}} №1:</label>
                            <span class="right-answer state-label">{{ __('question-create.Right')}}</span>
                            <textarea data-id="new-1" data-is_right="" class="form-answer-field" name="answer" type="text" value=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">{{ __('question-create.Answer')}} №2:</label>
                            <span class="right-answer state-label">{{ __('question-create.Right')}}</span>
                            <textarea data-id="new-2" data-is_right="" class="form-answer-field" name="answer" type="text" value=""></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="question-type-2 question-type-tab">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">{{ __('question-create.Answer')}} №1:</label>
                            <span class="right-answer state-label">{{ __('question-create.Right')}}</span>
                            <textarea data-id="new-1" data-is_right="" class="form-answer-field" name="answer" type="text" value="">Да</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">{{ __('question-create.Answer')}} №2:</label>
                            <span class="right-answer state-label">{{ __('question-create.Right')}}</span>
                            <textarea data-id="new-2" data-is_right="" class="form-answer-field" name="answer" type="text" value="">Нет</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="question-type-3 question-type-tab">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">{{ __('question-create.Answer_comparison')}} №1:</label>
                            <div class="flex">
                            <textarea data-id="new-1" data-pair="new-1" class="form-answer-field mr-3" name="answer" type="text" value=""></textarea>
                            <textarea data-id="new-2" data-pair="new-1" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">{{ __('question-create.Answer_comparison')}} №2:</label>
                            <div class="flex">
                            <textarea data-id="new-3" data-pair="new-3" class="form-answer-field mr-3" name="answer" type="text" value=""></textarea>
                            <textarea data-id="new-4" data-pair="new-3" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="question-type-4 question-type-tab">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">{{ __('question-create.Answer_chrono')}} №1:</label>
                            <div class="flex">
                                <textarea data-id="new-1" data-chrono="new-1" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">{{ __('question-create.Answer_chrono')}} №2:</label>
                            <div class="flex">
                                <textarea data-id="new-2" data-chrono="new-2" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="relative"><span data-form-id="100" class="plus-answer-variant">+</span></div>
                </div>


            <input type="hidden" data-name="type" class="form-main-field question-type" value="1">
            <button class="store-question-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ __('question-create.Save_btn')}}</button>
            </form>
        </div>
@endsection



