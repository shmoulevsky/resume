@extends('mng.master')
@section('title', 'Добавить тест')
@section('content')
<div class="tests-inner">
            
            
            

            <form class="styled-form w-6/12" >
                @csrf
                <div id="test-form" class="fields-wrap">
                    
                    <div class="mb-5">
                        <label class="full mb-3" for="">Название тестирования</label>
                        <input data-name="name" class="test-form-field" name="name" type="text" value="">
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">Текст перед тестированием</label>
                        <textarea data-name="description" class="test-form-field" name="description">Внимание! Сейчас начнется тестирование. На прохождение теста дается одна попытка. Желаем удачи!</textarea>
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">Время на тест в (мин.)</label>
                        <input data-name="timer" class="test-form-field" name="timer" type="text" value="30">
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">Выберите вопросы:</label>
                        <ul>
                        @forelse($questions as $question)
                            <li> <input data-name="question-<?=$question->id?>" class="inline-block mr-3 test-form-field" type="checkbox" name="question-<?=$question->id?>" id=""><span><?=$question->question?> (<?=$question->typeName?>)</span></li>
                        @empty
                            <p>добавьте вопросы для создания тестирования</p>
                        @endforelse
                        </ul>
                    </div>
                </div>
                


            <button id="test-save-btn" class="store-test-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            </form>
        </div>
@endsection
        

    
