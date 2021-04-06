@extends('mng.master')
@section('title', 'Список вопросов')

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('questions.list') }}</div>
<a href="{{route('questions.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Создать новую запись</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Дата создания</th>
            <th class="px-4 py-2">Вопрос</th>
            <th class="px-4 py-2">Тип вопроса</th>
            <th class="px-4 py-2">Баллы</th>
            <th class="px-4 py-2">Подробнее</th>

        </tr>

    </thead>

    <tbody>

        @forelse($questions as $question)

        <tr>

            <td class="border px-4 py-2">{{ $question->id }}</td>
            <td class="border px-4 py-2">{!! $question->formatDateTime !!}</td>
            <td class="border px-4 py-2">{{$question->question}}</td>
            <td class="border px-4 py-2">{{ $question->typeName }}</td>
            <td class="border px-4 py-2">{{ $question->points }}</td>

            <td class="border px-4 py-2">
                <a href="{{route('questions.detail', ['id' => $question->id])}}">Подробнее</a><br>
                <a class="delete-item" data-url="{{route('questions.delete', ['id' => $question->id])}}" href="#">Удалить</a>
            </td>

           

        </tr>
        @empty
            <tr><td class="p-5" colspan="9">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>

<div class="my-5">{{$questions->links()}}</div>

@endsection