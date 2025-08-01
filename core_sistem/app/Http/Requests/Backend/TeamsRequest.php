<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TeamsRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_divisi'=>'required',
            'name'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_active'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'id_divisi.required' => 'Pelase Select Divisi',
            'name.required' => 'Name is required',
            'photo.image' => 'Photo must be image type jpeg, jpg, png, atau svg',
            'status_active.required' => 'Pelase Select Status Active',
        ];
    }
}
