<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePesertaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $nomor = preg_replace('/[^0-9]/', '', $this->nomor_whatsapp);

        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        }

        $this->merge([
            'nomor_whatsapp' => $nomor,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'posyandu_id' => 'required|exists:posyandus,id',

            'nama_penerima' => 'required|string|max:255',

            'hubungan_penerima' => 'required|in:Ibu,Ayah,Wali,Diri Sendiri',

            'nama_peserta' => 'required|string|max:255',

            'jenis_peserta' => [
                'required',
                'string'
            ],

            'tanggal_lahir' => [
                'nullable',
                'required_if:jenis_peserta,Balita',
                'date',
                'before_or_equal:today',
            ],

            'status_kehamilan' => [
                'nullable',
                'required_if:jenis_peserta,Ibu Hamil',
                'in:Hamil,Melahirkan',
            ],

            'rt' => 'nullable|string|max:10',

            'nomor_whatsapp' => [
                'required',
                'regex:/^628[0-9]{8,13}$/',
            ],

            'status' => 'required|in:Aktif,Nonaktif',

        ];
    }
}
