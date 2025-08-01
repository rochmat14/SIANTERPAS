<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class DivisiRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Division Name is required',
        ];
    }
}
