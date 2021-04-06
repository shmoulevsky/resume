@extends('mng.master')
@section('title', 'Список собеседований')

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('interviews.list') }}</div>
<a href="{{route('interviews.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Создать новую запись</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Дата проведения</th>
            <th class="px-4 py-2">ФИО</th>
            <th class="px-4 py-2">Телефон</th>
            <th class="px-4 py-2">Статус</th>
            <th class="px-4 py-2">Подробнее</th>

        </tr>

    </thead>

    <tbody>

        @forelse($interviews as $interview)

        <tr>

            <td class="border px-4 py-2">{{ $interview->id }}</td>
            <td class="border px-4 py-2">{!! $interview->formatDateTimeInterview !!}</td>
            <td class="border px-4 py-2">{{ $interview->resume->full_name }}</td>
            <td class="border px-4 py-2">{{ $interview->resume->phone }}, {{ $interview->resume->email }}</td>
            <td class="border px-4 py-2">-</td>
            <td class="border px-4 py-2">
                <a href="{{route('interviews.detail', ['id' => $interview->id])}}">Подробнее</a><br>
                <a class="delete-item" data-url="{{route('interviews.delete', ['id' => $interview->id])}}" href="#">Удалить</a>
            </td>

           

        </tr>
        @empty
            <tr><td class="p-5" colspan="9">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>

<div class="my-5">{{$interviews->links()}}</div>

@endsection