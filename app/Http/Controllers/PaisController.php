<?php

namespace App\Http\Controllers;

use App\Http\Requests\DuplicidadNombrePaisRequest;
use App\Rules\pais\actualizar\DuplicidadNombreRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    public function index()
    {

        $sql = DB::select("select * from pais
                            where estado=1
                            order by id_pais desc ");

        return view("vistas/pais/pais", compact("sql"));
    }
    public function create()
    {
        return view("vistas/pais/registrar");
    }

    public function store(Request $request)
    {

        $request->validate([
            "nombre"=>["required","unique:App\Models\pais,nombre"]
        ]);
        try {
            $sql = DB::insert("insert into pais(nombre, estado) values(?,1)", [
                $request->nombre,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Pais registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }
    public function edit($id)
    {
        $sql = DB::select("select * from pais where id_pais=? and estado=1", [
            $id
        ]);


        return view('vistas/pais/actualizar', compact('sql'));
    }

    public function update(DuplicidadNombrePaisRequest $request, $id)
    {


        try {
            $sql = DB::update("update pais set nombre=? where id_pais=?", [
                $request->nombre,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Pais actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("update pais set estado=0 where id_pais=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Pais eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
