@extends('mng.master')
@section('title', 'Редактирование формы «‎'.$form->name.'»')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('forms.edit', $form) }}</div>    
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
                        <input data-name="name" class="form-main-field" name="name" type="text" value="{{$form->name}}">
                    </div>
                    @foreach($formsField as $field)
                    @switch($field->type)
                        @case(1)                     
                        <div data-id="{{$field->id}}" class="mb-5 relative field-wrap">
                            <label class="question-title" for="">Вопрос:</label><span class="question-required @if($field->is_required) active @endif">Обязательный</span>
                            <input data-type="1" data-id="{{$field->id}}" data-step="{{$field->step}}" data-sort="{{$field->sort}}" data-required="{{$field->is_required}}" data-size="{{$field->size}}" class="form-field" name="" type="text" value="{{$field->name}}">
                            <span data-id="{{$field->id}}" class="delete-field">-</span>
                        </div>
                        @break
                        @case(2) 
                        <div data-id="{{$field->id}}" class="mb-5 relative field-wrap">
                            <label class="question-title" for="">Вопрос:</label>
                            <span class="question-required @if($field->is_required) active @endif">Обязательный</span>
                            <textarea data-type="2" data-id="{{$field->id}}" data-ste{{$field->step}}="1" data-sort="{{$field->sort}}" data-required="{{$field->is_required}}" data-size="{{$field->size}}" class="form-field" name="" >{{$field->name}}</textarea>
                            <span data-id="{{$field->id}}" class="delete-field">-</span>
                        </div>
                        @break
                        @case(3)
                        <div data-id="{{$field->id}}" class="mb-5 relative field-wrap">
                        <label class="question-title" for="">Вопрос:</label>
                        <span class="question-required @if($field->is_required) active @endif">Обязательный</span>
                        <input data-type="3" data-id="{{$field->id}}" data-step="{{$field->step}}" data-sort="{{$field->sort}}" data-required="{{$field->is_required}}" data-size="{{$field->size}}" class="form-field" name="" type="text" value="{{$field->name}}">
                        <span data-id="{{$field->id}}" class="delete-field">-</span>
                        <div class="my-2 relative">
                            <span data-form-id="{{$field->id}}" class="plus-form-field-variant">+</span>
                        
                        <div class="flex relative">
                            <label class="mb-1" for="">Варианты ответа:</label>
                            <div class="form-field-variant-wrap">
                                @foreach($field->variants as $keyV => $variant)
                                <div class="flex">
                    
                                        <input data-id="{{$variant->id}}" data-points="10" data-field-id="{{$field->id}}" data-sort="{{$variant->sort}}" class="form-field-variant mt-1" name="" type="text" value="{{$variant->name}}">
                                        <input  class="form-field-variant-points mt-1" type="text" data-field-variant-id="{{$variant->id}}" value="{{$variant->points}}">
                                   
                                </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                        </div>
                        @break
                    @endswitch
                 @endforeach
                </div>
               
            <button class="update-form-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            <input type="hidden" value="{{$form->id}}"  id="fid">
            </form>
        </div>

@endsection


    
