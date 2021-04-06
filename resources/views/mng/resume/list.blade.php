@extends('mng.master')
@section('title', 'Список резюме')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('resume.list') }}</div>

            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100 border border-gray-100">

                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-25">Дата</th>
                        <th class="px-4 py-2">ФИО</th>
                        <th class="px-4 py-2">Вакансия</th>
                        <th class="px-4 py-2">Статус</th>
                        <th class="px-4 py-2 w-20">Балл</th>
                        <th class="px-4 py-2">Телефон</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Подробнее</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($resumes as $resume)

                    <tr>

                        <td class="border px-4 py-2"><a href="{{route('resume.detail', ['id' => $resume->id])}}">{{ $resume->id }}</a></td>
                        <td class="border px-4 py-2">{!! $resume->formatDateTime !!}</td>
                        <td class="border px-4 py-2"><a href="{{route('resume.detail', ['id' => $resume->id])}}">{{ $resume->full_name }}</a></td>
                        <td class="border px-4 py-2">{{ $resume->form->name }}</td>
                        <td class="border px-4 py-2"><span  class="active status-field border rounded-full py-1 px-2 mr-1 border-gray-300 text-sm field-variant {{$resume->status->code}}">{{$resume->status->name}}</span></td>
                        <td class="border px-4 py-2">{{ $resume->points }} б.</td>
                        <td class="border px-4 py-2">{{ $resume->phone }}</td>
                        <td class="border px-4 py-2">{{ $resume->email }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{route('resume.detail', ['id' => $resume->id])}}">Подробнее</a><br>
                            <a href="{{route('resume.export.pdf', ['id' => $resume->id])}}">Скачать PDF</a><br>
                            <a class="delete-item" data-url="{{route('resume.delete', ['id' => $resume->id])}}" href="#">Удалить</a>

                        </td>


                    </tr>
                    @empty
                        <tr><td class="p-5" colspan="9">Нет записей</td></tr>
                    @endforelse

                </tbody>

            </table>
            <div class="my-5">{{$resumes->links()}}</div>
@endsection  