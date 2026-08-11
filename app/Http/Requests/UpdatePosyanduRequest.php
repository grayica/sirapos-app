<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePosyanduRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_posyandu' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posyandus')->ignore($this->route('posyandu')),
            ],

            'dusun' => 'required|string|max:255',

            'lokasi' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_posyandu.required' => 'Nama Posyandu wajib diisi.',
            'nama_posyandu.unique'   => 'Nama Posyandu sudah terdaftar.',

            'dusun.required'         => 'Dusun wajib diisi.',

            'lokasi.required'        => 'Lokasi wajib diisi.',
        ];
    }
}
