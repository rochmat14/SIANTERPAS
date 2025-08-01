<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BlogStatusRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'id'=>'required',
            'publish'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID is required',
            'publish.required' => 'Status is required'
        ];
    }
}
