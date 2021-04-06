@extends('mng.master')
@section('title', 'Добавить вопрос')
@section('content')
<div class="questions-inner">
            <h3>Тип вопроса:</h3>
            <ul class="tab-wrap question-type-tab-title">
                <li data-type="1" class="active">Варианты ответа</li>
                <li data-type="2">Да/нет</li>
                <li data-type="3">Сопоставление</li>
                <li data-type="4">Хронология</li>
            </ul>
            <form class="styled-form w-6/12" >
                @csrf
                <div id="question-form" class="fields-wrap relative">
                    
                    <div class="mb-5">
                        <label for="">Вопрос:</label>
                        <textarea data-name="question" class="form-main-field" name="question" type="text" value=""></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">Описание:</label>
                        <textarea data-name="description" class="form-main-field" name="question" type="text" value=""></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="">Баллы за вопрос:</label>
                        <input data-name="points" class="form-main-field" name="points" type="text" value=""/>
                    </div>
                    <div class="question-type-1 question-type-tab active">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">Ответ №1:</label>
                            <span class="right-answer state-label">Правильный</span>
                            <textarea data-id="1" data-is_right="" class="form-answer-field" name="answer" type="text" value=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">Ответ №2:</label>
                            <span class="right-answer state-label">Правильный</span>
                            <textarea data-id="2" data-is_right="" class="form-answer-field" name="answer" type="text" value=""></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="question-type-2 question-type-tab">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">Ответ №1:</label>
                            <span class="right-answer state-label">Правильный</span>
                            <textarea data-id="1" data-is_right="" class="form-answer-field" name="answer" type="text" value="">Да</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-1" for="">Ответ №2:</label>
                            <span class="right-answer state-label">Правильный</span>
                            <textarea data-id="2" data-is_right="" class="form-answer-field" name="answer" type="text" value="">Нет</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="question-type-3 question-type-tab">
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
                    <div class="question-type-4 question-type-tab">
                    <div class="answers-wrap">
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">Ответ-хронология №1:</label>
                            <div class="flex">
                                <textarea data-id="1" data-chrono="1" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="answer-title answer-title-3" for="">Ответ-хронология №2:</label>
                            <div class="flex">
                                <textarea data-id="2" data-chrono="2" class="form-answer-field" name="answer" type="text" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="relative"><span data-form-id="100" class="plus-answer-variant">+</span></div>
                </div>
                

            <input type="hidden" data-name="type" class="form-main-field question-type" value="1">
            <button class="store-question-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            </form>
        </div>
@endsection
        

    
