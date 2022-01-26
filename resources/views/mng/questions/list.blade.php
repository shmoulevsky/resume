@extends('mng.master')
@section('title', __('question-list.Title'))

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('questions.list') }}</div>
<a href="{{route('questions.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">{{__('question-list.New_form_btn')}}</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('question-list.Table_date')}}</th>
            <th class="px-4 py-2">{{__('question-list.Table_question')}}</th>
            <th class="px-4 py-2">{{__('question-list.Table_question_type')}}</th>
            <th class="px-4 py-2">{{__('question-list.Table_points')}}</th>
            <th class="px-4 py-2">{{__('question-list.Table_actions')}}</th>

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
                <!--<a href="{{route('questions.detail', ['id' => $question->id])}}">{{__('question-list.Table_detail')}}</a><br>-->
                <a href="{{route('questions.edit', ['id' => $question->id])}}">{{__('question-list.Table_edit')}}</a><br>
                <a class="delete-item" data-url="{{route('questions.delete', ['id' => $question->id])}}" href="#">{{__('question-list.Table_delete')}}</a>
            </td>



        </tr>
        @empty
            <tr><td class="p-5" colspan="9">{{__('question-list.Table_No_records')}}</td></tr>
        @endforelse


    </tbody>

</table>

<div class="my-5">{{$questions->links()}}</div>

@endsection
