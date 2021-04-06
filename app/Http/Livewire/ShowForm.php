<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormsField;
use App\Models\Company;
use Illuminate\Http\Request;

class ShowForm extends Component
{
    
    public function mount(Request $request){
        dd($request->get('formId'));
    }

    public function render($companyCode, $formId, Request $request)
    {
        $company = Company::where(['code' => $companyCode])->first();
        $form = Form::where(['id' => $formId, 'company_id' => $company->id])->first();
        $formsField = FormsField::where(['form_id' => $formId])->get();
        
        return view('forms.show', [
            'company' => $company,
            'form' => $form,
            'formsField' => $formsField
        ]);

        return view('livewire.show-form');
    }
}
