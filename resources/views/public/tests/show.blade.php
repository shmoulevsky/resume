@extends('/layouts/public')
@section('title', 'Тестирование '.$test->name)
@section('content')
<div class="py-12 bg-gray-50 h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="resume-inner bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-10 relative">     
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Тестирование</span> &laquo;{{$test->name}}&raquo;</h1>
            <div id="timer" class="timer">--:--</div>
            <div class="block mt-12">
                <div class="test-wrap">
                    @include('public.tests.question', ['question' => $question, 'answersExist' => $answersExist, 'answersExistId' => $answersExistId])
                </div>
                <input type="hidden" id="trid" value="{{$testResult->id}}">
            </div>
            <div class="flex bottom-test-wrap">
                <div class="pagination-wrap">
                    <span class="title">Вопросы:</span>
                    <div class="flex">
                    <span style="display:none;" data-page="1" class="pagination-item question-page prev">🠐</span>
                    @for ($i = 1; $i <= $countQuestions; $i++)
                       
                        <span data-page="{{$i}}" class="pagination-item question-page question-page-number @if($i == 1) active @endif"><?=$i?></span>
                        
                    @endfor
                    <span data-page="2" class="pagination-item question-page next">🠒</span>
                    </div>
                    <input type="hidden" value="{{$countQuestions}}"  id="page-count">
                </div>
                <div>
                    <button class="finish-test bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Завершить тестирование</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
    
