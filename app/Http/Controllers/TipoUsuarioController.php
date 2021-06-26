<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        $sql = DB::select("select * from tipo_usuario");
        return view('vistas/tipo/tipoUsuario', compact("sql"));
    }    
}
