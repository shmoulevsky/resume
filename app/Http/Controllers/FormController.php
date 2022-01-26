<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Resume\ResumeService;
use App\Services\Form\FormService;

class FormController extends BaseController
{
    public function __construct(
        ResumeService $resumeService,
        FormService $formService
    ) {
        $this->resumeService = $resumeService;
        $this->formService = $formService;
    }

    public function index()
    {

        $companyCode = Auth::user()->company->code;
        $forms = $this->formService->formRepository->getListPaginateWithResumeCount(Auth::id(), 5);

        return view('mng.forms.list', compact('forms', 'companyCode'));
    }

    public function create()
    {
        return view('mng.forms.create');
    }

    public function edit(Request $request, $id)
    {
        list($form, $formsField) = $this->formService->getDataForEditForm($id);
        return view('mng.forms.edit', compact('form', 'formsField'));
    }

    public function store(Request $request)
    {
        $arForm = $request->post('form');
        $arFields = $request->post('fields');
        $arFieldsVariant = $request->post('fieldsVariant');
        $formId = intval($request->post('form_id'));

        $this->formService->saveForm($arForm, $arFields, $formId, $arFieldsVariant);

        return response()->json([
            'id' => $formId,
            'status' => 'success'
        ]);
    }

    public function delete($id, Request $request)
    {

        $item = $this->formService->formRepository->getById($id);
        $item->delete();
        $request->session()->flash('status', 'Запись удалена');

        return response()->json(['status' => 'deleted']);
    }
}
