<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SlideshowFormRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'url'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title slide is required',
            'url.required' => 'URL slide is required',
            'image.required' => 'Images slide is required',
            'image.image' => 'Sliders Image harus berformat Gambar jpeg, jpg, png, atau svg'
        ];
    }
}
