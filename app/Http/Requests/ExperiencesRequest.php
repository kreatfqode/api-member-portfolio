<?php

namespace App\Http\Requests;



class ExperiencesRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->getMethod()) {
            case 'POST': // Untuk membuat (store)
                return [
                    'id_programmers' => 'required|integer',
                    'tempat' => 'required',
                    'tahun' => 'required',
                    'bidang' => 'required',
                    'deskripsi' => 'nullable',
                ];
            case 'DELETE':
                return [
                    'id_experiences' => 'required',
                ];
            case 'GET':
                return [
                    'id_programmers' => 'nullable|integer',
                    'id_experiences' => 'nullable|integer',
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
            'id_programmers.integer' => 'id_programmer harus berupa angka',
            'id_projects.integer' => 'id_projects harus berupa angka',
        ];
    }
}
