<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id_usuario;
        $sql = DB::select("SELECT
        usuario.id_usuario,
        usuario.nombres,
        usuario.usuario,
        usuario.correo,
        usuario.foto,
        usuario.estado,
        tipo_usuario.nombre
        FROM
        usuario
        INNER JOIN tipo_usuario ON usuario.tipo = tipo_usuario.id_tipo_usuario
        where id_usuario=$id
        ");
        return view("vistas/usuarioProfile.usuario", compact("sql"));
    }
    public function update(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "usuario" => "required",
            "correo" => "required",
        ]);
        try {
            $sql = DB::update("update usuario set nombres=?, usuario=?, correo=? where id_usuario=?", [
                $request->nombre,
                $request->usuario,
                $request->correo,
                $request->id,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Datos modificados correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al modificar");
        }
    }
    public function updateImage(Request $request)
    {
        try {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        } catch (\Throwable $th) {
            $foto = "";
        }
        if ($foto == "") {
            return back()->with("AVISO", "Debe seleccionar una foto ...!");
        }

        try {
            $sql = DB::update(" update usuario set foto=? where id_usuario=? ", [
                $foto,
                $request->id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Imagen modificado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al modificar");
        }
    }
    public function destroyImage()
    {
        $id = Auth::user()->id_usuario;
        try {
            $sql = DB::update("update usuario set foto='' where id_usuario=$id ");
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Foto eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
