<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarProductoRequest;
use App\Http\Requests\RegistrarProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {

        $sql = DB::select("select * from producto
                            where estado=1
                            order by producto.id_producto desc ");

        return view("vistas/producto/producto", compact("sql"));
    }
    public function create()
    {
        return view("vistas/producto/registrar");
    }

    public function store(RegistrarProductoRequest $request)
    {

        try {
            $sql = DB::insert("insert into producto(nombre,descripcion,estado) values(?,?,1)", [
                $request->nombre,
                $request->descripcion,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }
    public function edit($id)
    {
        $sql = DB::select("select * from producto where id_producto=? and estado=1", [
            $id
        ]);


        return view('vistas/producto/actualizar', compact('sql'));
    }

    public function update(ActualizarProductoRequest $request, $id)
    {
        try {
            $sql = DB::update("update producto set nombre=?, descripcion=? where id_producto=?", [
                $request->nombre,
                $request->descripcion,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("update producto set estado=0 where id_producto=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
