@extends('mng.master')
@section('title', __('test-create.Title'))
@section('content')
<div class="tests-inner">

            <form class="styled-form w-6/12" >
                @csrf
                <div id="test-form" class="fields-wrap">

                    <div class="mb-5">
                        <label class="full mb-3" for="">{{__('test-create.Test_title')}}</label>
                        <input data-name="name" class="test-form-field" name="name" type="text" value="">
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">{{__('test-create.Text_before')}}</label>
                        <textarea data-name="description" class="test-form-field" name="description">{{__('test-create.Text_before_example')}}</textarea>
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">{{__('test-create.Time')}}</label>
                        <input data-name="timer" class="test-form-field" name="timer" type="text" value="30">
                    </div>
                    <div class="mb-5">
                        <label class="full mb-3" for="">{{__('test-create.Choose')}}:</label>
                        <ul>
                        @forelse($questions as $question)
                            <li> <input data-name="question-<?=$question->id?>" class="inline-block mr-3 test-form-field" type="checkbox" name="question-<?=$question->id?>" id=""><span><?=$question->question?> (<?=$question->typeName?>)</span></li>
                        @empty
                            <p>{{__('test-create.Add_questions')}}</p>
                        @endforelse
                        </ul>
                    </div>
                </div>



            <button id="test-save-btn" class="store-test-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{__('test-create.Save_btn')}}</button>
            </form>
        </div>
@endsection



