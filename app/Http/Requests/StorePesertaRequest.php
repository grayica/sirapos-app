<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesertaRequest extends FormRequest
{
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

    public function rules(): array
    {
        return [

            'posyandu_id' => 'required|exists:posyandus,id',

            'nama_penerima' => 'required|string|max:255',

            'hubungan_penerima' => 'required|in:Ibu,Ayah,Wali,Diri Sendiri',

            'nama_peserta' => 'required|string|max:255',

            'jenis_peserta' => 'nullable|string',

            'jenis_data' => [
                'required',
                'in:hamil,umum',
            ],

            'tanggal_lahir' => [
                'nullable',
                'required_if:jenis_data,umum',
                'date',
                'before_or_equal:today',
            ],

            'usia_kehamilan' => [
                'nullable',
                'required_if:jenis_data,hamil',
                'integer',
                'min:1',
                'max:45',
                
            ],

            'nomor_whatsapp' => [
                'required',
                'regex:/^628[0-9]{8,13}$/',
            ],

            'status' => 'required|in:Aktif,Nonaktif',

        ];
    }

    public function messages(): array
    {
        return [

            'posyandu_id.required' => 'Posyandu wajib dipilih.',
            'posyandu_id.exists' => 'Posyandu tidak valid.',

            'nama_penerima.required' => 'Nama penerima wajib diisi.',

            'hubungan_penerima.required' => 'Hubungan penerima wajib dipilih.',

            'nama_peserta.required' => 'Nama peserta wajib diisi.',

            'jenis_data.required' => 'Jenis data wajib dipilih.',

            'tanggal_lahir.required_if' =>
            'Tanggal lahir wajib diisi.',

            'tanggal_lahir.date' =>
            'Format tanggal lahir tidak valid.',

            'usia_kehamilan.required_if' =>
            'Usia kehamilan wajib diisi.',

            'usia_kehamilan.integer' =>
            'Usia kehamilan harus berupa angka.',

            'usia_kehamilan.min' =>
            'Usia kehamilan minimal 1 minggu.',

            'usia_kehamilan.max' =>
            'Usia kehamilan maksimal 40 minggu.',

            'tanggal_mulai_kehamilan.date' =>
            'Format tanggal mulai kehamilan tidak valid.',

            'nomor_whatsapp.required' =>
            'Nomor WhatsApp wajib diisi.',

            'nomor_whatsapp.regex' =>
            'Nomor WhatsApp harus menggunakan format 628xxxxxxxxxx.',

            'status.required' =>
            'Status wajib dipilih.',

        ];
    }
}
