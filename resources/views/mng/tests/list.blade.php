@extends('mng.master')
@section('title', __('test-list.Title'))

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('tests.list') }}</div>
<a href="{{route('tests.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">{{__('test-list.New_form_btn')}}</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('test-list.Table_date')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_title')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_type')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_count')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_actions')}}</th>

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
                <a href="{{route('tests.edit', ['id' => $test->id])}}">{{__('test-list.Table_edit')}}</a><br>
                <a href="{{route('tests.detail', ['id' => $test->id])}}">{{__('test-list.Table_detail')}}</a><br>
                <a class="delete-item" data-url="{{route('tests.delete', ['id' => $test->id])}}" href="#">{{__('test-list.Table_delete')}}</a>
            </td>



        </tr>
        @empty
            <tr><td class="p-5" colspan="9">{{__('test-list.Table_No_records')}}</td></tr>
        @endforelse


    </tbody>

</table>

<div class="my-5">{{$tests->links()}}</div>

@endsection
