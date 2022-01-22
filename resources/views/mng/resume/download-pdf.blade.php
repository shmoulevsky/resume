<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$data['resume']->last_name}} {{$data['resume']->name}} {{$data['resume']->second_name}}</title>

</head>

<body>
<style>
    @font-face {
      font-family: "DejaVu Sans";
      font-style: normal;
      font-weight: 400;
      src: url("/fonts/dejavu-sans/DejaVuSans.ttf");
      /* IE9 Compat Modes */
      src:
        local("DejaVu Sans"),
        local("DejaVu Sans"),
        url("/fonts/dejavu-sans/DejaVuSans.ttf") format("truetype");
    }
    body {
      font-family: "DejaVu Sans";
      font-size: 12px;
    }

    table th{
        background-color: #eee;
        color: #111;
        font-weight: bold;
    }

    table td, table th{
        border: 1px solid #ccc;
        padding: 5px 20px;
    }
    table{
        border-collapse: collapse;
        margin: 20px 0px;
    }

    .active{
        font-weight: bold;
        text-decoration: underline;
    }

    .flex{
        /* display: flex; */
    }

    .fio{
        font-weight: bold;
        font-size: 17px;
    }

    h1{
        color: #777;
    }

</style>
<div class="py-12 bg-gray-50 h-screen">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="resume-inner bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-10">
            <div style="display:none;" class="resume-err mb-12 text-red-500 border-2 border-red-300 rounded py-3 px-6"></div>
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Резюме на вакансию</span> &laquo;{{$data['form']->name}}&raquo;</h1>

            <div class="flex">
                <div class="my-5 flex resume-top">
                    @if(isset($userPhoto))
                        <div style="margin-bottom: 10px;" class="resume-photo"><img width="120" src="{{public_path($userPhoto->src)}}" alt="" srcset=""></div>
                    @endif
                    <div>
                    <div class="text-xl my-2 block" ><span class="fio">{{$data['resume']->last_name}} {{$data['resume']->name}} {{$data['resume']->second_name}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$data['resume']->phone}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$data['resume']->email}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$data['resume']->created_at}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">Статус: {{$data['resume']->status->name}}</span></div>
                    <div class="text-xl my-2 block" ><span id="total-points" class="">{{$resume->points}} {{Helper::declOfNum($resume->points, ['балл','балла','баллов'])}}</span></div>
                    </div>
                </div>

            </div>
            <br>
            <br>
            @if($experience)
            <div class="block mt-12">
                @include('mng.resume.include.experience', ['experience' => $experience])
            </div>
            <br>
            <br>
            @endif

            @if($education)
            <div class="block mt-12">
                @include('mng.resume.include.education', ['education' => $education])
            </div>
            <br>
            <br>
            @endif
            <div class="block mt-12">
            @foreach($data['formFields'] as $key => $field)
            @isset($field->answers->first()->id)
            @switch($field->type)
                @case(1)
                    <div class="my-6">
                        <span class="text-xl my-2 block font-bold text-gray-400">{{$key+1}}. {{$field->name}}:</span>
                        <span class="text-xl my-2 block">{!!$field->answers->first()->answer!!}</span>
                    </div>
                    @break
                @case(2)
                    <div class="my-6">
                        <span class="text-xl my-2 block font-bold text-gray-400">{{$key+1}}. {{$field->name}}:</span>
                        <span class="text-xl my-2 block">{!!$field->answers->first()->answer!!}</span>
                    </div>
                    @break
                 @case(3)
                    <div class="my-6">
                        <label class="text-xl block mb-3 my-2 block font-bold text-gray-400" for="">{{$key+1}}. {{$field->name}}:</label>
                        @foreach($field->variants as $variant)
                            <span data-label="resume:{{$field->id}}#{{$variant->id}}" class="resume-field border-2 rounded-full py-1 px-3 mx-1 border-purple-500 field-variant @if(in_array($variant->id, $field->answers->pluck('forms_fields_variants_id')->toArray())) active @endif"><?=$variant->name?></span>
                        @endforeach
                    </div>
                    @break
                @default


            @endswitch
            @endisset
            @endforeach


            </div>
        </div>

    </div>

</div>
</body>
</html>
