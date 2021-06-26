<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $estado = Auth::user()->estado;
        if ($estado == 1) {
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
        } else {
            session()->invalidate();
            session()->regenerateToken();
            return back()->with('mensaje', 'USUARIO ELIMINADO, consulte con el Administrador');
        }
    }
}
