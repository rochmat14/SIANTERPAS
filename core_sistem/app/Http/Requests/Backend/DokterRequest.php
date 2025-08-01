<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class DokterRequest extends FormRequest
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
            'nama_dokter'=>'required',
            'spesialis_id'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:10048'
        ];
    }

    public function messages()
    {
        return [
            'nama_dokter.required' => 'Nama Dokter is required',
            'spesialis_id.required' => 'Spesialis is required'
        ];
    }
}
