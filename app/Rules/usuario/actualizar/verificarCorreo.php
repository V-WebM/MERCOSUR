<?php

namespace App\Rules\usuario\actualizar;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class verificarCorreo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $correo="")
    {
        $this->id=$id;
        $this->correo=$correo;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value, $id=0)
    {
        $verificarCorreo = DB::select("select count(*) as total from usuario where correo=? and id_usuario!=? and estado=1", [
            $value,
            $this->id
        ]);
        if ($verificarCorreo[0]->total > 0) {
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
        return "El correo $this->correo ya existe.";
    }
}
