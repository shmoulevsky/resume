@extends('/layouts/public')
@section('title', 'Информация о тестировании')
@section('content')
<div class="py-12 bg-gray-50 h-screen">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="resume-inner bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-10">
            
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Тестирование</span> &laquo;{{$test->name}}&raquo;</h1>
            <h2 class="text-2xl mb-2"><span class="text-gray-400">Компания:</span> {{$company->name}}</h2>
            <h2 class="text-2xl mb-10"><span class="text-gray-400">Время на тест:</span> 30 мин.</h2>
            
            
                
            
            
            @if(!$isPassed)
            <div class="mb-5">{{$test->description}}</div>
            <input type="hidden" id="code" value="{{$code}}">
            <input type="hidden" id="company" value="{{$companyId}}">
            <button class="mt-6 proccess-test border-2 rounded-full py-3 px-6 border-purple-500 hover:bg-purple-500 hover:text-white">Начать тест</button>
            @else
            <div>Тест был пройден Вами ранее.</div>
            @endif

            </div>
        </div>

    </div>

</div>
@endsection
    
