<?php

namespace App\Http\Requests;



class SkillsRequest extends CoreRequest
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
                    'id_skills' => 'required|integer',
                ];
            case 'DELETE':
                return [
                    'id_programmers' => 'required|integer',
                    'id_skills' => 'required|integer',
                ];
            case 'GET':
                return [
                    'id_programmers' => 'nullable|integer',
                    'id_programmers_not' => 'nullable|integer',
                    'search' => 'nullable',
                ];
            default:
                return [];
        }
    }
    public function messages(): array
    {
        return [
            'id_programmers.required' => 'id_programmers tidak boleh dikosongkan',
            'id_skills.required' => 'id_skills tidak boleh dikosongkan',
            'id_programmers.integer' => 'id_programmer harus berupa angka',
            'id_skills.integer' => 'id_skills harus berupa angka',
        ];
    }
}
