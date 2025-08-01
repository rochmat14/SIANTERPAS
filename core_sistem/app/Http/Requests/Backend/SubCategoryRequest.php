<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name_en'=>'required',
            'name_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name_en.required' => 'Category (English) is required',
            'name_id.required' => 'Category (Indonesia) is required',
        ];
    }
}
