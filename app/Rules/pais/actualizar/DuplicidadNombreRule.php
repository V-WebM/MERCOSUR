<?php

namespace App\Rules\pais\actualizar;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DuplicidadNombreRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id = 0, $nombre="")
    {
        $this->id = $id;
    $this->nombre=$nombre;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $verNombre = DB::select("select count(*) as total from pais where nombre=? and id_pais!=? and estado=1", [
            $value,
            $this->id
        ]);
        if ($verNombre[0]->total > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "El nombre $this->nombre ya existe.";
    }
}
