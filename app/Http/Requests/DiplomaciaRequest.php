<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiplomaciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "pais1" => "required",
            "pais2" => "required",
            "fecha" => "required"
        ];
    }

    public function messages()
    {
        return [
            'pais1.required' => 'Debe seleccionar un pais',
            'pais2.required' => 'Debe seleccionar un pais',
        ];
    }
}
