<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportarController extends Controller
{
    public function index()
    {

        $sql = DB::select("select * from exportar where estado=1 ");
        $pais = DB::select("select * from pais ");
        $producto = DB::select("select * from producto ");

        return view("vistas/exportar/exportar", compact("sql", "pais", "producto"));
    }
    public function create()
    {
        $sql = DB::select(" select * from pais where estado=1 ");
        $pais = DB::select("select * from pais where estado=1");
        $producto = DB::select("select * from producto where estado=1");
        return view("vistas/exportar/registrar", compact("sql", "pais", "producto"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "pais1"=>"required",
            "pais2"=>"required",
            "producto"=>"required"
        ]);

        if ($request->pais1 == $request->pais2) {
            return back()->with("AVISO", "Los paises deben ser diferentes");
        }

        try {
            $sql = DB::insert("insert into exportar(pais1, pais2, producto, estado) values(?,?,?,1)", [
                $request->pais1,
                $request->pais2,
                $request->producto,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Exportacion registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }
    public function edit($id)
    {
        $sql = DB::select(" select * from exportar where id_exportar=$id");
        $pais = DB::select("select * from pais");
        $producto = DB::select("select * from producto ");
        return view('vistas/exportar/actualizar', compact("sql", "pais","producto"));
    }

    public function update(Request $request, $id)
    {
        if ($request->pais1 == $request->pais2) {
            return back()->with("AVISO", "Los paises deben ser diferentes");
        }

        try {
            $sql = DB::update("update exportar set pais1=?, pais2=?, producto=? where id_exportar=?", [
                $request->pais1,
                $request->pais2,
                $request->producto,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Exportacion actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("delete from exportar where id_exportar=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Exportacion eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
