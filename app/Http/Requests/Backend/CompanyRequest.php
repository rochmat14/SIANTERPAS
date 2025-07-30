<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'category'=>'required',
            'company_name'=>'required',
            'logo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'category.required' => 'Category is required',
            'company_name.required' => 'Company name is required',
            'logo.image' => 'Photo must be image type jpeg, jpg, png, atau svg',
            'publish.required' => 'Pelase Select Status Publish / Draft',
        ];
    }
}
