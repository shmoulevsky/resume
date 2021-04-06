@extends('/layouts/public')
@section('title', 'Вакансия '.$form->name.' от компании '.$company->name)
@section('content')
<div class="wait-bg"><span class="text-2xl text-xl">Отправка</span></div>
<div class="md:py-12 bg-gray-50 h-screen">

    <div class="max-w-7xl mx-auto lg:px-8">

        <div class="resume-inner bg-white overflow-hidden md:shadow-xl sm:rounded-lg md:p-10 p-4">
            <div style="display:none;" class="resume-err inline-block mb-12 text-red-500 border-2 border-red-300 rounded py-3 px-6"></div>
            <h1 class="md:text-4xl text-2xl md:mb-5 mb-3"><span class="text-gray-400">Резюме на вакансию</span> &laquo;{{$form->name}}&raquo;</h1>
            <h2 class="md:text-2xl text-xl md:mb-10 mb-6"><span class="text-gray-400">Компания:</span> {{$company->name}}</h2>
            <div class="step-wrap my-5">
                <ul class="form-step">
                    <li data-id="1" class="active">Шаг 1: Инфо</li>
                    <li data-id="2">Шаг 2: Опыт и образование</li>
                    <li data-id="3">Шаг 3: Анкета</li>
                </ul>
            </div>
            <div data-id="1" class="form-tab active">
            <div class="md:flex mb-4">
            <div>
                <label class="text-xl my-2 block" for="">Фамилия<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <input data-label="resume:last_name" class="resume-field w-full required border border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div class="md:ml-5 md:mr-5">
                <label class="text-xl my-2 block" for="">Имя<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <input data-label="resume:name" class="resume-field w-full required border border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div>
                <label class="text-xl my-2 block" for="">Отчество<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <input data-label="resume:second_name" class="resume-field w-full required border border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            </div>

            <div class="md:flex">
            <div class="">
                <label class="text-xl my-2 block" for="">Телефон<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <input data-label="resume:phone" class="resume-field phone required border border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div class="md:ml-5">
                <label class="text-xl my-2 block" for="">E-mail<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <input data-label="resume:email" class="resume-field required border border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div class="md:ml-5">
                <label class="text-xl my-2 block" for="">Фото (макс. 3Мб)<span class="text-gray-400 ml-1 text-sm">*</span></label>
                <div class="file-dropzone px-5" id="user-photo">Выберите файл (до 3Мб)</div>
            </div>
            </div>
            <button class="mt-10 next-form-btn border-2 rounded-full py-3 px-6 border-purple-500 hover:bg-purple-500 hover:text-white">Далее</button>
            </div>
            
            <div data-id="2" class="form-tab">
            <div class="mt-10 relative">
            <h3 class="text-xl font-bold my-2 block">Стаж работы<span class="text-gray-400 ml-1 text-sm">*</span></h3>
            <div class="experience-wrap">
                <div class="mb-2 experience-field" data-id="0">
                    <div class="md:flex">                  
                    <div>
                        <label class="text-xl my-2 block" for="">Организация</label>
                        <input data-label="company_name"  class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
                    </div>
                    <div class="md:ml-5 md:mr-5">
                        <label class="text-xl my-2 block" for="">Должность</label>
                        <input data-label="position" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
                    </div>
                    <div>
                        <label class="text-xl my-2 block" for="">Период работы</label>
                        <input data-label="period" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
                    </div>
                    </div>
                    <div class="mb-2">
                        <div><label class="text-xl my-2 block" for="">Должностные обязанности</label></div>
                        <textarea data-label="description" class="mw-728 border lg:w-4/6 w-full border-gray-300 block resize-none focus:ring-purple-600" ></textarea>
                    </div>
                </div>
            </div>
            <span class="add-item add-expreience">Добавить еще место работы +</span>    
            </div>

            <div class="mt-10 relative">
            <h3 class="text-xl font-bold my-2 block">Образование<span class="text-gray-400 ml-1 text-sm">*</span></h3>
            <div class="education-wrap">
            <div data-id="0" class="md:flex mb-2 education-field">
            <div>
                <label class="text-xl my-2 block" for="">Учеб. заведение</label>
                <input data-label="place" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div class="md:ml-5 md:mr-5">
                <label class="text-xl my-2 block" for="">Специальность</label>
                <input data-label="specialisation" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            <div>
                <label class="text-xl my-2 block" for="">Период обучения</label>
                <input  data-label="period" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
            </div>
            </div>
            </div>
            <span class="add-item add-education">Добавить еще уч. заведение +</span>    
            </div>
            <button class="mt-10 prev-form-btn border-2 rounded-full py-3 px-6 border-purple-500 hover:bg-purple-500 hover:text-white">Назад</button>
            <button class="mt-10 next-form-btn border-2 rounded-full py-3 px-6 border-purple-500 hover:bg-purple-500 hover:text-white">Далее</button>
            </div>

            <div data-id="3" class="form-tab">
            <div class="block mt-12">
            @foreach($formsField as $field)
            @switch($field->type)
                @case(1)
                    <div class="my-6">
                        <label class="text-xl my-2 block" for="">{{$field->name}}@if($field->is_required == 1)<span class="text-gray-400 ml-1 text-sm">*</span>@endif</label>
                        <input data-label="resume:{{$field->id}}" class="resume-field {{$field->required_class}} md:w-6/12 w-full border border-gray-300 block focus:ring-purple-600" type="text" value="">
                    </div>
                    @break
                @case(2)
                    <div class="my-6">
                        <label class="text-xl my-2 block" for="">{{$field->name}}@if($field->is_required == 1)<span class="text-gray-400 ml-1 text-sm">*</span>@endif</label>
                        <textarea data-label="resume:{{$field->id}}" class="md:w-6/12 w-full border resume-field {{$field->required_class}} border-gray-300 block resize-none focus:ring-purple-600" name="" id="" ></textarea>
                    </div>
                    @break
                 @case(3)
                    <div class="my-6">
                        <label class="text-xl block mb-3 my-2 block" for="">{{$field->name}}@if($field->required == 1)<span class="text-gray-400 ml-1 text-sm">*</span>@endif</label>
                        <div class="block">
                        @foreach($field->variants as $keyV => $variant)
                            <div class="mb-5">
                                <span data-label="resume:{{$field->id}}#{{$variant->id}}" class="resume-field rounded-full py-1 px-3 mx-1 border-purple-500 cursor-pointer hover:bg-purple-500 border-2 field-variant"><?=$keyV+1?>.<?=$variant->name?></span>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @break    
                @default

                    
            @endswitch
       
            @endforeach
            <input type="hidden" id="fid" value="{{$form->id}}">
            <input type="hidden" id="cid" value="{{$company->code}}">
            <div class="files-fields-wrap"></div>
            <button class="mt-10 prev-form-btn border-2 rounded-full py-3 px-6 border-purple-500 hover:bg-purple-500 hover:text-white">Назад</button>
            <button class="mt-10 send-resume-btn border-2 rounded-full py-3 px-6 border-green-500 bg-green-500 text-white">Отправить</button>
            </div>
            </div>
        </div>

    </div>

</div>
@endsection
    
