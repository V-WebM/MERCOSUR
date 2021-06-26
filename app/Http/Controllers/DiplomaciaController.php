<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiplomaciaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiplomaciaController extends Controller
{
    public function index()
    {

        $sql = DB::select("select * from diplomacia where estado=1 ");
        $pais = DB::select("select * from pais ");

        return view("vistas/diplomacia/diplomacia", compact("sql", "pais"));
    }
    public function create()
    {
        $sql = DB::select(" select * from pais where estado=1 ");
        return view("vistas/diplomacia/registrar", compact("sql"));
    }

    public function store(DiplomaciaRequest $request)
    {
        if ($request->pais1 == $request->pais2) {
            return back()->with("AVISO", "Los paises deben ser diferentes");
        }

        try {
            $sql = DB::insert("insert into diplomacia(pais1, pais2, fecha, estado) values(?,?,?,1)", [
                $request->pais1,
                $request->pais2,
                $request->fecha,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Diplomacia registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }
    public function edit($id)
    {
        $sql = DB::select(" select * from diplomacia where id_diplomacia=$id");
        $pais = DB::select("select * from pais");
        return view('vistas/diplomacia/actualizar', compact("sql", "pais"));
    }

    public function update(Request $request, $id)
    {
        if ($request->pais1 == $request->pais2) {
            return back()->with("AVISO", "Los paises deben ser diferentes");
        }

        try {
            $sql = DB::update("update diplomacia set pais1=?, pais2=?, fecha=? where id_diplomacia=?", [
                $request->pais1,
                $request->pais2,
                $request->fecha,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Diplomacia actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("delete from diplomacia where id_diplomacia=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Diplomacia eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
