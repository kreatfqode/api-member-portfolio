<?php

namespace App\Http\Requests;



class ProgrammersRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->getMethod()) {
            case 'POST':
                return [
                ];
            case 'PUT':
                return [
                    'id_programmers' => 'required',
                    'email' => 'nullable|email',
                    'password' => 'nullable',
                    'nama_panggilan' => 'nullable',
                    'nama_lengkap' => 'nullable',
                    'warna_primary' => 'nullable',
                    'warna_secondary' => 'nullable',
                    'foto_utama' => 'nullable',
                    'foto_tentang' => 'nullable',
                    'tentang_diri' => 'nullable',
                    'tentang_skill' => 'nullable',
                    'tentang_pengalaman' => 'nullable',
                    'tentang_project' => 'nullable',
                    'alamat' => 'nullable',
                    'no_telp' => 'nullable|integer',
                    'mulai_karir' => 'nullable',
                    'moto_project' => 'nullable',
                    'pdf_cv' => 'nullable',
                ];
            case 'GET':
                return [
                    'id' => 'nullable|integer',
                    'email' => 'nullable',
                    'search' => 'nullable',
                    'start' => 'nullable',
                    'length' => 'nullable',
                ];
            default:
                return [];
        }
    }
    public function messages(): array
    {
        return [
            'id.integer' => 'id harus berupa angka',
        ];
    }
}
