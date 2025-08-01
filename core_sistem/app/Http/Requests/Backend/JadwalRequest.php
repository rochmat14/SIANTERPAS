<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class JadwalRequest extends FormRequest
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
            'dokter_id' => [
                'required',
                'integer',
                // Memeriksa apakah dokter_id sudah ada dengan status 1 dalam tabel kk_set_jadwal
                function ($attribute, $value, $fail) {
                    $exists = DB::table('kk_set_jadwal')
                                ->where('dokter_id', $value)
                                ->where('status', 1)
                                ->exists();
                    if ($exists) {
                        $fail('Dokter dengan ID yang sama sudah terdaftar dan aktif.');
                    }
                },
                
            ],
        ];
    }

    public function messages()
    {
        return [
            'dokter_id.required' => 'Kolom Dokter wajib diisi',
        ];
    }
}
