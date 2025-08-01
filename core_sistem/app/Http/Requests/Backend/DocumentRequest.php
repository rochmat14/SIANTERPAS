<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'document_title'=>'required',
            'category'=>'required',
            'document_file'=>'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:10048',
            'publish'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'document_title.required' => 'Document title is required',
            'category.required' => 'Category is required',
            'document_file.required'    => 'Document must be upload',
            'document_file.mimes'     => 'Document must be PDF , Doc, image type jpeg, jpg, png, atau svg',
            'document_file.max'     => 'Document maximum 10048 KB',
            'publish.required' => 'Pelase Select Status Publish / Draft',
        ];
    }
}
