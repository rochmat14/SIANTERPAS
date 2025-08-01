<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'title_id'=>'required',
            'description_id'=>'required',
            'slug'=>'required|unique:kk_blogs,slug',
            'image'=>'image|max:500|mimes:jpeg,jpg,bmp,png,PNG',
        ];
    }
    public function messages()
    {
        return [
            'title_id.required' => 'Title is required',
            'description_id.required' => 'Deskripsi is required',
            'slug.required' => 'Slug is required',
            'image.image' => 'Gambar harus berupa file images seperti jpeg, jpg, png, bmp',
        ];
    }
}
