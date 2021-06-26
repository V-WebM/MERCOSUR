<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\RegistrarUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {

        $sql = DB::select("SELECT
        usuario.id_usuario,
        usuario.nombres,
        usuario.usuario,
        usuario.correo,
        usuario.foto,
        tipo_usuario.nombre
        FROM
        usuario
        INNER JOIN tipo_usuario ON usuario.tipo = tipo_usuario.id_tipo_usuario        
        where usuario.estado=1
        order by usuario.id_usuario desc");

        return view("vistas/usuario/usuario", compact("sql"));
    }

    public function create()
    {
        $sql = DB::select("select * from tipo_usuario");

        return view("vistas/usuario/registrar", compact("sql"));
    }

    public function store(RegistrarUsuario $request)
    {

        try {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        } catch (\Throwable $th) {
            $foto = "";
        }
        $claveE = md5($request->password);
        try {
            if ($foto == "") {
                $sql = DB::insert("insert into usuario(nombres,usuario,password,correo,estado,tipo) values(?,?,?,?,1,?)", [
                    $request->nombre,
                    $request->usuario,
                    $claveE,
                    $request->correo,
                    $request->tipo,
                ]);
            } else {
                $sql = DB::insert("insert into usuario(nombres,usuario,password,correo,foto,estado,tipo) values(?,?,?,?,?,1,?)", [
                    $request->nombre,
                    $request->usuario,
                    $claveE,
                    $request->correo,
                    $foto,
                    $request->tipo,
                ]);
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Usuario registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }

    public function actualizarImagen(Request $request)
    {

        try {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        } catch (\Throwable $th) {
            $foto = "";
        }

        if ($foto == "") {
            return back()->with("INCORRECTO", "No se ha seleccionado ninguna foto");
        } else {
            try {
                $sql = DB::update("update usuario set foto=? where id_usuario=?", [
                    $foto,
                    $request->id
                ]);
                if ($sql == 0) {
                    $sql = 1;
                }
            } catch (\Throwable $th) {
                $sql = 0;
            }
        }




        if ($sql == 1) {
            return back()->with("CORRECTO", "Foto del perfil actualizado");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }

    public function eliminarImagen($id)
    {
        try {
            $sql = DB::update("update usuario set foto=? where id_usuario=?", [
                "",
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Foto del perfil eliminado");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }


    public function edit($id)
    {
        $sql = DB::select("select * from usuario where id_usuario=? and estado=1", [
            $id
        ]);

        $sql2 = DB::select("select * from tipo_usuario");

        return view('vistas/usuario/actualizar', compact('sql'))->with("tipoUsuario", $sql2);
    }

    public function update(ActualizarUsuarioRequest $request, $id)
    {

        //$claveE = md5($request->password);


        try {
            $sql = DB::update("update usuario set nombres=?, usuario=?, correo=?, tipo=? where id_usuario=?", [
                $request->nombre,
                $request->usuario,                
                $request->correo,
                $request->tipo,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Usuario actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("delete from usuario where id_usuario=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Usuario eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
