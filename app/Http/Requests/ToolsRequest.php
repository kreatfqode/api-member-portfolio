<?php

namespace App\Http\Requests;



class ToolsRequest extends CoreRequest
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
                    'id_tools' => 'required|integer',
                ];
            case 'DELETE':
                return [
                    'id_programmers' => 'required|integer',
                    'id_tools' => 'required|integer',
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
            'id_tools.required' => 'id_tools tidak boleh dikosongkan',
            'id_programmers.integer' => 'id_programmer harus berupa angka',
            'id_tools.integer' => 'id_tools harus berupa angka',
        ];
    }
}
