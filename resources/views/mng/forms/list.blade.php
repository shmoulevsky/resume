@extends('mng.master')
@section('title', __('form-list.Title'))
@section('content')
<div class="mb-5">{{ Breadcrumbs::render('forms.list', $forms) }}</div>

            <a href="{{route('forms.create')}}"  class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">{{__('form-list.New_form_btn')}}</a>



            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100 border border-gray-100">

                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-25">{{__('form-list.Table_Name')}}</th>
                        <th class="px-4 py-2">{{__('form-list.Table_Date_create')}}</th>
                        <th class="px-4 py-2">{{__('form-list.Table_Date_update')}}</th>
                        <th class="px-4 py-2">{{__('form-list.Table_Resume_count')}}</th>
                        <th class="px-4 py-2">{{__('form-list.Table_Detail')}}</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($forms as $form)

                    <tr>

                        <td class="border px-4 py-2">{{ $form->id }}</td>
                        <td class="border px-4 py-2">{{ $form->name }}</td>
                        <td class="border px-4 py-2">{!! $form->formatDateTime !!}</td>
                        <td class="border px-4 py-2">{{ $form->updated_at }}</td>
                        <td class="border px-4 py-2">{{ $form->resume_count}}</td>

                        <td class="border px-4 py-2">
                            <a target="_blank" href="{{route('resume.public.create', ['company' => $companyCode ,'id' => $form->id])}}">{{__('form-list.Table_See')}}</a><br>
                            <a href="{{route('forms.edit', ['id' => $form->id])}}">{{__('form-list.Table_Edit')}}</a>
                            <a class="delete-item" data-url="{{route('forms.delete', ['id' => $form->id])}}" href="#">{{__('form-list.Table_Delete')}}</a>
                        </td>



                    </tr>

                    @empty
                        <tr><td class="p-5" colspan="9">{{__('form-list.No_records')}}</td></tr>
                    @endforelse

                </tbody>

            </table>
            <div class="my-5">{{$forms->links()}}</div>
@endsection
