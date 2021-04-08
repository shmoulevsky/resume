@extends('mng.master')
@section('title', 'Создание новой формы')
@section('content')<div class="mb-5">{{ Breadcrumbs::render('forms.create') }}</div>    
    
        <div class="resume-inner">
            
            <div class="mb-5">
                <h3 class="mb-5">Добавить поле</h3>
                <span data-type="1" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">короткий ответ</span>
                <span data-type="2" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">расширенный ответ</span>
                <span data-type="3" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">на выбор</span>
            </div>
            

            <form class="styled-form w-6/12" >
                @csrf
                <div id="resume-form" class="fields-wrap">
                    
                    <div class="mb-5">
                        <label for="">Вакансия</label>
                        <input data-name="name" class="form-main-field" name="name" type="text" value="Продавец">
                    </div>
                    <p id="empty-form-text">Создайте свой первый вопрос!</p>
                    
                </div>
                


            <button class="store-form-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            </form>
        </div>

@endsection


    
