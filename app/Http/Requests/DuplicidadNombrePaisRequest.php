<?php

namespace App\Http\Requests;

use App\Rules\pais\actualizar\DuplicidadNombreRule;
use Illuminate\Foundation\Http\FormRequest;

class DuplicidadNombrePaisRequest extends FormRequest
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
            "nombre" => ["required",new DuplicidadNombreRule(request()->id,request()->nombre)],
        ];
    }
}
