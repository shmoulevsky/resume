@extends('mng.master')
@section('title', 'Список резюме')
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('resume.list') }}</div>

<div class="flex">
@forelse($resumeStatuses as $status)
    <div class="status-column-wrap">  
        <span class="status-column-title {{$status->code}}">{{$status->name}}</span>  
        <div class="status-column">
        
                @if(!empty($resumes[$status->id]))
                @forelse($resumes[$status->id] as $key => $resume)
                    <div draggable="true" class="resume-item">
                        <span class="num {{$status->code}}">{{$key+1}}</span>
                        <a class="title" href="{{route('resume.detail', ['id' => $resume->id])}}">{{$resume->fullname}}</a>
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