@extends('/layouts/public')
@section('title', 'Вакансия '.$form->name.' от компании '.$company->name)
@section('content')
<div class="py-12 bg-gray-50 h-screen">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="resume-inner bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-10">
            <div style="display:none;" class="resume-err mb-12 text-red-500 border-2 border-red-300 rounded py-3 px-6"></div>
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Резюме на вакансию</span> &laquo;{{$form->name}}&raquo;</h1>
            <h2 class="text-2xl mb-10"><span class="text-gray-400">Компания:</span> {{$company->name}}</h2>           
            
            
            <div class="block mt-12">
                <h2>Список тестов:</h2>
                @foreach($testResume as $test)
                    <div>
                        <a target="_blank" href="{{route('test.public.info',[$company->id, $test->code])}}">{{$test->test->name}}</a>
                    </div>
                @endforeach
          
            </div>
        </div>

    </div>

</div>
@endsection
    
