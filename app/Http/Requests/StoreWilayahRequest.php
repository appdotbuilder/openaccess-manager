<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWilayahRequest extends FormRequest
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
            'nama_wilayah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'koordinat_lat' => 'nullable|numeric|between:-90,90',
            'koordinat_lng' => 'nullable|numeric|between:-180,180',
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
            'nama_wilayah.required' => 'Nama wilayah harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'kota.required' => 'Kota harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'desa.required' => 'Desa harus diisi.',
            'koordinat_lat.numeric' => 'Koordinat latitude harus berupa angka.',
            'koordinat_lat.between' => 'Koordinat latitude harus antara -90 dan 90.',
            'koordinat_lng.numeric' => 'Koordinat longitude harus berupa angka.',
            'koordinat_lng.between' => 'Koordinat longitude harus antara -180 dan 180.',
        ];
    }
}