<?php

namespace App\Http\Requests;



class ProjectsRequest extends CoreRequest
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
                    'nama' => 'required',
                    'gambar' => 'required',
                    'tanggal' => 'required',
                    'link' => 'nullable',
                    'teknologi' => 'required',
                ];
            case 'DELETE':
                return [
                    'id_projects' => 'required|integer',
                ];
            case 'GET':
                return [
                    'id_project' => 'nullable|integer',
                    'id_programmers' => 'required|integer',
                    'id_skills' => 'nullable|integer',
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
