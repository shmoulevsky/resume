@extends('mng.master')
@section('title', 'Список резюме')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('resume.list') }}</div>
<div class="my-3">
    <ul class="tab-wrap">
        <li class="@if($currentRoute == 'resume.list') active @endif"><a href="{{route('resume.list')}}">Список</a></li>
        <li class="@if($currentRoute == 'resume.list.canban') active @endif"><a href="{{route('resume.list.canban')}}">Канбан</a></li>
    </ul>
</div>
<div class="flex">
@forelse($resumeStatuses as $status)
    <div class="status-column-wrap {{$status->code}}">  
        <span class="status-column-title {{$status->code}}">{{$status->name}}</span>  
        <div data-status="{{$status->id}}" id="status-column-{{$status->code}}" class="status-column">
        
                @if(!empty($resumes[$status->id]))
                @forelse($resumes[$status->id] as $key => $resume)
                    <div data-id="{{$resume->id}}" class="resume-item">
                        @if(isset($photos[$resume->id]))
                        <img class="" src="{{$photos[$resume->id]->url}}/{{$photos[$resume->id]->name}}" alt="">
                        @endif
                        <span class="num">{{$key+1}}</span>
                        <div>
                           <a class="title" href="{{route('resume.detail', ['id' => $resume->id])}}">{{$resume->fullname}}</a>
                            <div class="phone">{{$resume->form->name}}</div> 
                            <div class="phone my">{!! $resume->formatDateTime !!}</div> 
                            <div class="phone">{{$resume->phone}}</div> 
                        </div>
                        
                    </div>
                @empty  
                @endforelse
            @endif
        </div>
    </div>
   
@empty
    Нет записей
@endforelse
</div>
@endsection  