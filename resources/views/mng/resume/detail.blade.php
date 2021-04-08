@extends('mng.master')
@section('title', 'Резюме: '.$resume->full_name)
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('resume.detail', $resume) }}</div>

        <div class="resume-inner">
            <div style="display:none;" class="resume-err mb-12 text-red-500 border-2 border-red-300 rounded py-3 px-6"></div>
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Резюме на вакансию</span> &laquo;{{$form->name}}&raquo;</h1>
  
            <div class="flex">
            
                <div class="my-5 resume-top flex">
                    @if($userPhoto)
                        <div class="resume-photo"><img src="{{$userPhoto->src}}" alt="" srcset=""></div>
                    @endif
                    <div>
                    <div class="text-xl my-2 block" ><span class="">{{$resume->last_name}} {{$resume->name}} {{$resume->second_name}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$resume->phone}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$resume->email}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{!!$resume->formatDateTime!!}</span></div>
                    <div class="text-xl my-2 block" ><span id="total-points" class="">{{$resume->points}} {{Helper::declOfNum($resume->points, ['балл','балла','баллов'])}}</span></div>
                    <div class="text-lg underline text-blue-700  my-2 block" ><span class="relative"><a target="_blank" href="{{route('resume.public.show', [$companyId, $resume->code])}}">ссылка на профиль</a><span class="copy-icon copy-public-resume-url" data-url="{{route('resume.public.show', [$companyId, $resume->code])}}"></span></span></div>
                    <div class="text-xl mb-2 mt-6 block" >
                    @foreach($resumeStatuses as $status)
                        <span data-status-id="{{$status->id}}" data-resume-id="{{$resume->id}}" data-label="status:{{$status->id}}" class="status-field status-field-btn @if($status->id == $resume->status->id) active @endif border rounded-full py-1 px-2 mr-1 border-gray-300 text-sm field-variant {{$status->code}}">{{$status->name}}</span>
                    @endforeach
                    </div>
                    </div>
                </div>

            </div>

            @if($experience)
            <div class="block mt-12">
                @include('mng.resume.include.experience', ['experience' => $experience])
            </div>
            @endif

            @if($education)
            <div class="block mt-12">
                @include('mng.resume.include.education', ['education' => $education])
            </div>
            @endif

            <div class="block mt-12">
            @foreach($formFields as $key => $field)
            @isset($field->answers->first()->id)
            @switch($field->type)
                @case(1)
                    <div class="my-6">
                        <span class="text-xl my-2 block font-bold text-gray-400">{{$key+1}}. {{$field->name}} ({{$field->answers->first()->points}} {{Helper::declOfNum($field->answers->first()->points, ['балл','балла','баллов'])}}):</span>
                        <span class="text-xl my-2 block">{!!$field->answers->first()->answer!!}</span>
                        <div class="points-field-wrap"><input data-id="{{$field->answers->first()->id}}" value="{{$field->answers->first()->points}}" class="points-field" type="text"><span>{{Helper::declOfNum($field->answers->first()->points, ['балл','балла','баллов'])}}</span> (введите от 0 до 100)</div>
                    </div>
                    @break
                @case(2)
                    <div class="my-6">
                        <span class="text-xl my-2 block font-bold text-gray-400">{{$key+1}}. {{$field->name}} ({{$field->answers->first()->points}} {{Helper::declOfNum($field->answers->first()->points, ['балл','балла','баллов'])}}):</span>
                        <span class="text-xl my-2 block">{!!$field->answers->first()->answer!!}</span>
                        <div class="points-field-wrap"><input data-id="{{$field->answers->first()->id}}" value="{{$field->answers->first()->points}}" class="points-field" type="text"><span>{{Helper::declOfNum($field->answers->first()->points, ['балл','балла','баллов'])}}</span> (введите от 0 до 100)</div>
                    </div>
                    @break
                 @case(3)
                    <div class="my-6">
                        <label class="text-xl block mb-3 my-2 block font-bold text-gray-400" for="">{{$key+1}}. {{$field->name}} ({{$field->answers->first()->points}} {{Helper::declOfNum($field->answers->first()->points, ['балл','балла','баллов'])}}):</label>
                        @foreach($field->variants as $variant)
                            <span data-label="resume:{{$field->id}}#{{$variant->id}}" class="resume-field border-2 rounded-full py-1 px-3 mx-1 border-purple-500 field-variant @if(in_array($variant->id, $field->answers->pluck('forms_fields_variants_id')->toArray())) active bg-purple-500 text-white @endif"><?=$variant->name?></span>
                           
                        @endforeach
                    </div>
                    @break    
                @default

                    
            @endswitch
            @endisset
            @endforeach
            <input type="hidden" id="fid" value="{{$form->id}}">
           
            </div>

           
            <div class="my-5">
            <span>Действия:</span>
            <a href="{{route('resume.list')}}"  class="inline-block border border-gray-200 hover:border-gray-400 font-bold py px-2 rounded my-3">К списку</a>
            <a href="#" id="change-points" class="inline-block change-points border-blue-500 border hover:bg-blue-500 hover:text-white font-bold py px-3 rounded mb-6">Оценить</a>
            <a href="#" id="create-interview" class="inline-block border-green-500 border hover:bg-green-500 hover:text-white font-bold py px-3 rounded mb-6">Создать собеседование</a>
            <a href="{{route('resume.export.pdf', ['id' => $resume->id])}}" class="inline-block border-purple-600 border hover:bg-purple-600 hover:text-white font-bold py px-3 rounded mb-6">Скачать PDF</a>
            <a href="#" id="assign-test" class="inline-block border-purple-600 border hover:bg-purple-600 hover:text-white font-bold py px-3 rounded mb-6">Назначить тест</a>
            <input type="hidden" id="rid" value="{{$resume->id}}"/>
            </div>

            <div class="my-8">
                <div>
                    <ul class="tab-wrap_links">
                        <li data-tab="1" class="active">Комментарии</li>
                        <li data-tab="2">Тесты</li>
                        <li data-tab="3">Результаты тестирования</li>
                        <li data-tab="4">Собеседования</li>
                    </ul>
                </div>

                <div data-tab="1" class="my-5 links-tab active">
                    @include('mng.resume.include.comments', ['resume' => $resume])
                </div>
                <div data-tab="2" class="my-5 links-tab">
                    @include('mng.resume.include.tests-assign', ['testResults' => $testResults])
                </div>
                <div data-tab="3" class="my-5 links-tab">
                    @include('mng.resume.include.tests-results', ['testResults' => $testResults])
                </div>
                <div data-tab="4" class="my-5 links-tab">
                    @include('mng.resume.include.interviews', ['interviews' => $interviews])
                </div>    
            </div>    
@endsection
    
