<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->input('action') === 'draft') {
            return [
                'posyandu_id' => 'nullable|exists:posyandus,id',
                'tanggal'     => 'nullable|date',
                'jam'         => 'nullable',
                'lokasi'      => 'nullable|string|max:255',
            ];
        }

        return [
            'posyandu_id' => 'required|exists:posyandus,id',
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'lokasi'      => 'required|string|max:255',
        ];
    }
}
