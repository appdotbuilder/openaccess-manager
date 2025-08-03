<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'paket_internet_id' => 'required|exists:paket_internet,id',
            'wilayah_id' => 'required|exists:wilayah,id',
            'username_pppoe' => 'nullable|string|unique:pelanggan,username_pppoe',
            'password_pppoe' => 'nullable|string',
            'ip_address' => 'nullable|ip',
            'status' => 'required|in:aktif,non_aktif,expired,suspend',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pelanggan harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'paket_internet_id.required' => 'Paket internet harus dipilih.',
            'paket_internet_id.exists' => 'Paket internet tidak valid.',
            'wilayah_id.required' => 'Wilayah harus dipilih.',
            'wilayah_id.exists' => 'Wilayah tidak valid.',
            'username_pppoe.unique' => 'Username PPPoE sudah digunakan.',
            'ip_address.ip' => 'Format IP Address tidak valid.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_berakhir.required' => 'Tanggal berakhir harus diisi.',
            'tanggal_berakhir.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
        ];
    }
}