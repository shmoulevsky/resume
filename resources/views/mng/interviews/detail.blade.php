@extends('mng.master')
@section('title', 'Собеседование: '.$interview->resume->full_name)
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('interviews.detail', $interview->resume->full_name, $interview->id) }}</div>
            
            <h1 class="text-4xl mb-5"><span class="text-gray-400">Собеседование на вакансию</span> &laquo;{{$form->name}}&raquo;</h1>
  
            <div class="flex">
            
                <div class="my-5">
                    <div class="text-xl my-2 block" ><span class="">{{$interview->resume->full_name}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$interview->resume->phone}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$interview->resume->email}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{!!$interview->formatDateTime!!}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$interview->place}}</span></div>
                    <div class="text-xl my-2 block" ><span class="">{{$interview->comment}}</span></div>
                    
                </div>

            </div>

            <a href="{{route('interviews.list')}}"  class="inline-block border border-gray-200 hover:border-gray-400 font-bold py-2 px-4 rounded my-3">К списку</a>

@endsection
        

    
