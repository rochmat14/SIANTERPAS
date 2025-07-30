<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialEditRequest extends FormRequest
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
            'name'=>'required',
            'subtitle'=>'required',
            'text'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'subtitle.required' => 'Subtitle is required',
            'text.required' => 'Text is required',
            'text.image' => 'Photo harus berformat Gambar jpeg, png,jpg, gif atau SVG',
        ];
    }
}
