<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosyanduRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_posyandu' => 'required|string|max:255',
            'dusun'         => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_posyandu.required' => 'Nama Posyandu wajib diisi.',
            'dusun.required'         => 'Dusun wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
        ];
    }
}
