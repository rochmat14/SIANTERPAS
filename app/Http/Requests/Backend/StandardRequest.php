<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StandardRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'standard'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'standard.required' => 'Auditor name is required'
        ];
    }
}
