@extends('mng.master')
@section('title', __('interview-list.Title'))

@section('content')
<div class="mb-5">{{ Breadcrumbs::render('interviews.list') }}</div>
<a href="{{route('interviews.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">{{__('interview-list.New_interview_btn')}}</a>
<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('interview-list.Table_Date')}}</th>
            <th class="px-4 py-2">{{__('interview-list.Table_FIO')}}</th>
            <th class="px-4 py-2">{{__('interview-list.Table_Phone')}}</th>
            <th class="px-4 py-2">{{__('interview-list.Table_Status')}}</th>
            <th class="px-4 py-2">{{__('interview-list.Table_Actions')}}</th>

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
                <a href="{{route('interviews.detail', ['id' => $interview->id])}}">{{__('interview-list.Table_Detail')}}</a><br>
                <a class="delete-item" data-url="{{route('interviews.delete', ['id' => $interview->id])}}" href="#">{{__('interview-list.Table_Delete')}}</a>
            </td>



        </tr>
        @empty
            <tr><td class="p-5" colspan="9">{{__('interview-list.Table_No_records')}}</td></tr>
        @endforelse


    </tbody>

</table>

<div class="my-5">{{$interviews->links()}}</div>

@endsection
