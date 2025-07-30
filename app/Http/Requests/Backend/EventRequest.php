<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_title'=>'required',
            'date_from'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'auditor_name.required' => 'Auditor name is required',
            'date_from.required' => 'Date name is required',
            'image.image' => 'Image must be type jpeg, jpg, png, atau svg',
            'publish.required' => 'Pelase Select Status Publish / Draft',
        ];
    }
}
