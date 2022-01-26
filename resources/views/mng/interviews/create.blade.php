@extends('mng.master')
@section('title', __('interview-create.Title'))
@section('content')

<form class="styled-form w-6/12" >
    @csrf
    <div class="fields-wrap">

        <div class="mb-5">
            <label for="">{{__('interview-create.Resume')}}</label>
            <select class="interview-form-field" data-name="resume-id">
                <option value="0">{{__('interview-create.Choose_resume')}}</option>
            @forelse($resume as $res)
                <option value="{{$res->id}}">{{$res->last_name}} {{$res->name}} {{$res->second_name}}</option>
            @empty
            @endforelse
            </select>
        </div>

        <div class="mb-5">
            <label for="">{{__('interview-create.Date')}}</label>
            <input data-name="datetime" data-required="1" class="date-time interview-form-field" name="" value="">
        </div>


    </div>
    <button id="interview-save-btn" class="text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{__('interview-create.Save_btn')}}</button>
</form>



@endsection



