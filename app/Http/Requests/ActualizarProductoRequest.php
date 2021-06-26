<?php

namespace App\Http\Requests;

use App\Rules\producto\actualizar\verificarNombre;
use Illuminate\Foundation\Http\FormRequest;

class ActualizarProductoRequest extends FormRequest
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
            "nombre" => ["required", new verificarNombre(request()->id)],
        ];
    }

    public function messages()
    {
        return [
            "cate.required" => "Debe seleccionar una categoria",
        ];
    }
}
