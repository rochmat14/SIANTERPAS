<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AuditorRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'auditor_name'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'auditor_name.required' => 'Auditor name is required',
            'photo.image' => 'Photo must be image type jpeg, jpg, png, atau svg',
            'publish.required' => 'Pelase Select Status Publish / Draft',
        ];
    }
}
