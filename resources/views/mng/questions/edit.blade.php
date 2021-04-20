@extends('mng.master')
@section('title', 'Редактирование вопроса')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('questions.edit', $question) }}</div>
<div class="questions-inner">
            
            <form class="styled-form w-6/12" >
                @csrf
                <div id="question-form" class="fields-wrap relative">
                    
                    <div class="mb-5">
                        <label for="">Вопрос:</label>
                        <textarea data-name="question" class="form-main-field" name="question" type="text" >{{$question->question}}</textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">Описание:</label>
                        <textarea data-name="description" class="form-main-field" name="question" type="text" value="{{$question->description}}"></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">Баллы за вопрос:</label>
                        <input data-name="points" class="form-main-field" name="points" type="text" value="{{$question->points}}"/>
                    </div>
                    @switch($question->type)
                    @case(1)
                    <div class="question-type-1 question-type-tab active">
                    <div class="answers-wrap">
                        @php $index = 0; @endphp
                        @foreach($question->answers as $answer)
                        <div class="mb-3">
                            @php $index ++; @endphp
                            <label class="answer-title answer-title-1" for="">Ответ №{{$index}}:</label>
                            <span class="right-answer state-label @if($answer->points > 0) active @endif">Правильный</span>
                            <textarea data-id="{{$answer->id}}" data-is_right=" @if($answer->points > 0) 1 @endif" class="form-answer-field" name="answer" type="text" >{{$answer->answer}}</textarea>
                        </div>
                        @endforeach
                    </div>
                    
                    </div>
                    @break
                    @case(2)
                    <div class="question-type-2 question-type-tab active">
                    <div class="answers-wrap">
                        @php $index = 0; @endphp
                        @foreach($question->answers as $answer)
                        @php $index ++; @endphp
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">Ответ №{{$index}}:</label>
                            <span class="right-answer state-label @if($answer->points > 0) active @endif">Правильный</span>
                            <textarea data-id="{{$answer->id}}" data-is_right="{{$answer->is_right}}" class="form-answer-field" name="answer" type="text" >{{$answer->answer}}</textarea>
                        </div>
                        @endforeach
                    </div>
                    </div>
                    @break
                    @case(3)
                    <div class="question-type-3 question-type-tab active">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">Ответ-сопоставление №1:</label>
                            <div class="flex">
                            <textarea data-id="1" data-pair="1" class="form-answer-field mr-3" name="answer" type="text" value=""></textarea>
                            <textarea data-id="2" data-pair="1" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">Ответ-сопоставление №2:</label>
                            <div class="flex">
                            <textarea data-id="3" data-pair="3" class="form-answer-field mr-3" name="answer" type="text" value=""></textarea>
                            <textarea data-id="4" data-pair="3" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                    @break
                    @case(4)
                    <div class="question-type-4 question-type-tab active">
                    <div class="answers-wrap">
                        @php $index = 0; @endphp
                        @foreach($question->answers as $answer)
                        @php $index ++; @endphp
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">Ответ-хронология №{{$index}}:</label>
                            <div class="flex">
                                <textarea data-id="{{$answer->id}}" data-chrono="{{$answer->number}}" class="form-answer-field" name="answer" type="text" >{{$answer->answer}}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                    
                @break
                @endswitch
                <div class="relative"><span data-form-id="100" class="plus-answer-variant">+</span></div>
                </div>

                <input type="hidden" data-name="type" class="form-main-field question-type" value="{{$question->type}}">
                <input type="hidden" data-name="question-id" class="form-main-field question-type" value="{{$question->id}}">
            <button class="store-question-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            </form>
        </div>
@endsection
        

    
