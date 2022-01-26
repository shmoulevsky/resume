@extends('mng.master')
@section('title', __('resume-list.Title'))
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('resume.list') }}</div>
<div class="my-3">
    <ul class="tab-wrap">
        <li class="@if($currentRoute == 'resume.list') active @endif"><a href="{{route('resume.list')}}">{{__('resume-list.Table_View_list')}}</a></li>
        <li class="@if($currentRoute == 'resume.list.canban') active @endif"><a href="{{route('resume.list.canban')}}">{{__('resume-list.Table_View_canban')}}</a></li>
    </ul>
</div>
            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100 border border-gray-100">

                        <th class="px-4 py-2 w-20">No.</th>

                        <th class="px-4 py-2">{{__('resume-list.Table_Photo')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_FIO')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_Vacancy')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_Status')}}</th>
                        <th class="px-4 py-2 w-20">{{__('resume-list.Table_Points')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_Phone')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_Email')}}</th>
                        <th class="px-4 py-2 w-25">{{__('resume-list.Table_Date')}}</th>
                        <th class="px-4 py-2">{{__('resume-list.Table_Actions')}}</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($resumes as $resume)

                    <tr>

                        <td class="border px-4 py-2"><a href="{{route('resume.detail', ['id' => $resume->id])}}">{{ $resume->id }}</a></td>

                        <td class="border px-4 py-2">@if(isset($photos[$resume->id]))
                        <a href="{{route('resume.detail', ['id' => $resume->id])}}">
                        <img class="resume-photo-list" src="{{$photos[$resume->id]->url}}/{{$photos[$resume->id]->name}}" alt=""></a>
                        @endif</td>
                        <td class="border px-4 py-2"><a href="{{route('resume.detail', ['id' => $resume->id])}}">{{ $resume->full_name }}</a></td>
                        <td class="border px-4 py-2">{{ $resume->form->name }}</td>
                        <td class="border px-4 py-2"><span  class="active status-field border rounded-full py-1 px-2 mr-1 border-gray-300 text-sm field-variant {{$resume->status->code}}">{{__('resume-status.'.$resume->status->name)}}</span></td>
                        <td class="border px-4 py-2">{{ $resume->points }} б.</td>
                        <td class="border px-4 py-2">{{ $resume->phone }}</td>
                        <td class="border px-4 py-2 "><span style="word-break: break-word;" class="break-words">{{ $resume->email }}</span></td>
                        <td class="border px-4 py-2">{!! $resume->formatDateTime !!}</td>
                        <td class="border px-4 py-2">
                            <a href="{{route('resume.detail', ['id' => $resume->id])}}">{{__('resume-list.Table_Detail')}}</a><br>
                            <a href="{{route('resume.export.pdf', ['id' => $resume->id])}}">{{__('resume-list.Table_Download_PDF')}}</a><br>
                            <a class="delete-item" data-url="{{route('resume.delete', ['id' => $resume->id])}}" href="#">{{__('resume-list.Table_Delete')}}</a>

                        </td>


                    </tr>
                    @empty
                        <tr><td class="p-5" colspan="9">{{__('resume-list.Table_No_records')}}</td></tr>
                    @endforelse

                </tbody>

            </table>
            <div class="my-5">{{$resumes->links()}}</div>
@endsection
