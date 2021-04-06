@extends('mng.master')
@section('title', 'Создание новой формы')
@section('content')
    
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
                    <!-- 
                    <div class="mb-5">
                        <label for="">Вопрос:</label>
                        <input data-type="1" data-id="100" data-step="1" data-sort="100" data-required="1" data-size="100" class="form-field" name="" type="text" value="Желаемый доход">
                    </div>
                    <div class="mb-5">
                        <label for="">Вопрос:</label>
                        <textarea data-type="2" data-id="101" data-step="1" data-sort="100" data-required="1" data-size="100" class="form-field" name="" >Опишите Ваш опыт продаж</textarea>
                    </div>
                    <div class="mb-5 ">
                        <label for="">Вопрос:</label>
                        <input data-type="3" data-id="102" data-step="1" data-sort="100" data-required="1" data-size="100" class="form-field" name="" type="text" value="Что по вашему является наиболее важным в продажах?">
                        <div class="mt-1">
                            <div class="flex">
                                <label class="mb-1" for="">Варианты ответа:</label>
                                <div class="">
                                    <input data-id="103" data-points="10" data-field-id="102" data-sort="100" class="form-field-variant" class="" name="" type="text" value="коммуникация">
                                    <input data-id="104" data-points="10" data-field-id="102" data-sort="100" class="form-field-variant" class="mt-1" name="" type="text" value="владение предметной областью">
                                    <input data-id="105" data-points="10" data-field-id="102" data-sort="100" class="form-field-variant" class="mt-1" name="" type="text" value="внешний вид">
                                </div>
                            </div>
                            
                            
                        </div>
                    </div> -->
                </div>
                


            <button class="store-form-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
            </form>
        </div>

@endsection


    
