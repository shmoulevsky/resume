@extends('mng.master')
@section('title', 'Список форм')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('forms.list', $forms) }}</div>

            <a href="{{route('forms.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Создать новую запись</a>

            

            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100 border border-gray-100">

                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-25">Название</th>
                        <th class="px-4 py-2">Дата создания</th>
                        <th class="px-4 py-2">Дата обновления</th>
                        <th class="px-4 py-2">Кол-во резюме</th>
                        <th class="px-4 py-2">Подробнее</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($forms as $form)

                    <tr>

                        <td class="border px-4 py-2">{{ $form->id }}</td>
                        <td class="border px-4 py-2">{{ $form->name }}</td>
                        <td class="border px-4 py-2">{!! $form->formatDateTime !!}</td>
                        <td class="border px-4 py-2">{{ $form->updated_at }}</td>
                        <td class="border px-4 py-2">{{ $form->resume_count}}</td>
                        
                        <td class="border px-4 py-2">
                            <a target="_blank" href="{{route('resume.public.create', ['company' => $companyCode ,'id' => $form->id])}}">Просмотр формы</a><br>
                            <a href="{{route('forms.edit', ['id' => $form->id])}}">Редактировать</a>
                            <a class="delete-item" data-url="{{route('forms.delete', ['id' => $form->id])}}" href="#">Удалить</a>
                        </td>

                       

                    </tr>

                    @empty
                        <tr><td class="p-5" colspan="9">Нет записей</td></tr>
                    @endforelse

                </tbody>

            </table>
            <div class="my-5">{{$forms->links()}}</div>
@endsection
