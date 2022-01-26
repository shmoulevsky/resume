@extends('mng.master')
@section('title',  __('form-create.Title'))
@section('content')<div class="mb-5">{{ Breadcrumbs::render('forms.create') }}</div>

        <div class="resume-inner">

            <div class="mb-5">
                <h3 class="mb-5">{{__('form-create.Add_field')}}</h3>
                <span data-type="1" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">{{__('form-create.Short_answer')}}</span>
                <span data-type="2" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">{{__('form-create.Full_answer')}}</span>
                <span data-type="3" class="add-field-button cursor-pointer border-purple-500 text-white border-2 rounded-full py-1 px-3 mx-1 bg-purple-500 field-variant">{{__('form-create.Choose_answer')}}</span>
            </div>


            <form class="styled-form w-6/12" >
                @csrf
                <div id="resume-form" class="fields-wrap">

                    <div class="mb-5">
                        <label for="">{{__('form-create.Vacancy')}}</label>
                        <input data-name="name" class="form-main-field" name="name" placeholder="{{__('form-create.Placeholder_title')}}" type="text" value="">
                    </div>
                    <p id="empty-form-text">{{__('form-create.Create_first_question')}}</p>

                </div>



            <button class="store-form-btn text-white bg-indigo-500 mt-8 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{__('form-create.Save_btn')}}</button>
            </form>
        </div>

@endsection



