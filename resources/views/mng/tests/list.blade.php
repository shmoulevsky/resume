@extends('mng.master')
@section('title', 'Список тестов')

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('tests.list') }}</div>
<a href="{{route('tests.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Создать новую запись</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Дата создания</th>
            <th class="px-4 py-2">Название</th>
            <th class="px-4 py-2">Тип</th>
            <th class="px-4 py-2">Кол-во вопросов</th>
            <th class="px-4 py-2">Подробнее</th>

        </tr>

    </thead>

    <tbody>

        @forelse($tests as $test)

        <tr>

            <td class="border px-4 py-2">{{ $test->id }}</td>
            <td class="border px-4 py-2">{!! $test->formatDateTime !!}</td>
            <td class="border px-4 py-2">{{ $test->name }}</td>
            <td class="border px-4 py-2">{{ $test->type }}</td>
            <td class="border px-4 py-2">{{ $test->questions_count }}</td>

            <td class="border px-4 py-2">
                <a href="{{route('tests.detail', ['id' => $test->id])}}">Подробнее</a><br>
                <a class="delete-item" data-url="{{route('tests.delete', ['id' => $test->id])}}" href="#">Удалить</a>
            </td>

           

        </tr>
        @empty
            <tr><td class="p-5" colspan="9">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>

<div class="my-5">{{$tests->links()}}</div>

@endsection