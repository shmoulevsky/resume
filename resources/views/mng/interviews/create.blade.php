@extends('mng.master')
@section('title', 'Добавить собеседование')
@section('content')
        
<form class="styled-form w-6/12" >
    @csrf
    <div class="fields-wrap">
        
        <div class="mb-5">
            <label for="">Претендент</label>
            <select class="interview-form-field" data-name="resume-id">
                <option value="0">выберите резюме</option>
            @forelse($resume as $res)
                <option value="{{$res->id}}">{{$res->last_name}} {{$res->name}} {{$res->second_name}}</option>
            @empty    
            @endforelse 
            </select>
        </div>
        
        <div class="mb-5">
            <label for="">Дата</label>
            <input data-name="datetime" data-required="1" class="date-time interview-form-field" name="" value="">
        </div>
        
            
    </div>
    <button id="interview-save-btn" class="text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Сохранить</button>
</form>

            

@endsection
        

    
