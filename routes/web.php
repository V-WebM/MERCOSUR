<?php

use App\Http\Controllers\CambiarClaveController;
use App\Http\Controllers\DiplomaciaController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* USUARIO PROFILE */
Route::get("mi-perfil", [PerfilController::class, 'index'])->name("perfil.index")->middleware('verified');
Route::post("perfil-actualizar", [PerfilController::class, 'update'])->name("perfil.update")->middleware('verified');
Route::post("perfil-actualizar-foto", [PerfilController::class, 'updateImage'])->name("perfil.updateImage")->middleware('verified');
Route::get("perfil-eliminar-foto", [PerfilController::class, 'destroyImage'])->name("perfil.destroyImage")->middleware('verified');


/* CAMBIAR CLAVE */
Route::get("clave-ver", [CambiarClaveController::class, 'index'])->name("clave.index")->middleware('verified');
Route::post("clave-actualizar", [CambiarClaveController::class, 'update'])->name("clave.update")->middleware('verified');


/* tipo usuario */
Route::get('/tipo-usuario', [TipoUsuarioController::class, 'index'])->name("tipo.index")->middleware('verified');

/* usuario */
Route::get("/usuario", [UsuarioController::class, "index"])->name("usuario.index")->middleware("verified");
Route::get("/usuario-crear", [UsuarioController::class, "create"])->name("usuario.create")->middleware("verified");
Route::post("/usuario-registrar", [UsuarioController::class, "store"])->name("usuario.store")->middleware("verified");
Route::post("/usuarioActualizar-{id}", [UsuarioController::class, "update"])->name("usuario.update")->middleware('verified');
Route::get("/usuario-editar-{id}", [UsuarioController::class, "edit"])->name("usuario.edit")->middleware('verified');
Route::post("/usuario-modificarImagen", [UsuarioController::class, "actualizarImagen"])->name("usuario.actualizarImagen")->middleware('verified');
Route::get("/usuario-eliminarImagen-{id}", [UsuarioController::class, "eliminarImagen"])->name("usuario.eliminarImagen")->middleware('verified');
Route::get("/usuario-eliminar-{id}", [UsuarioController::class, "destroy"])->name("usuario.destroy")->middleware('verified');

/* producto */
Route::get("/producto", [ProductoController::class, "index"])->name("producto.index")->middleware("verified");
Route::get("/producto-crear", [ProductoController::class, "create"])->name("producto.create")->middleware("verified");
Route::post("/producto-registrar", [ProductoController::class, "store"])->name("producto.store")->middleware("verified");
Route::post("/producto-{id}", [ProductoController::class, "update"])->name("producto.update")->middleware('verified');
Route::get("/producto-editar-{id}", [ProductoController::class, "edit"])->name("producto.edit")->middleware('verified');
Route::get("/producto-eliminar-{id}", [ProductoController::class, "destroy"])->name("producto.destroy")->middleware('verified');

/* paises */
Route::get("/pais", [PaisController::class, "index"])->name("pais.index")->middleware("verified");
Route::get("/pais-crear", [PaisController::class, "create"])->name("pais.create")->middleware("verified");
Route::post("/pais-registrar", [PaisController::class, "store"])->name("pais.store")->middleware("verified");
Route::post("/pais-{id}", [PaisController::class, "update"])->name("pais.update")->middleware('verified');
Route::get("/pais-editar-{id}", [PaisController::class, "edit"])->name("pais.edit")->middleware('verified');
Route::get("/pais-eliminar-{id}", [PaisController::class, "destroy"])->name("pais.destroy")->middleware('verified');


/* RELACION DIPLOMACIAS */

Route::get("/diplomacias", [DiplomaciaController::class, "index"])->name("diplomacias.index")->middleware("verified");
Route::get("/diplomacias-crear", [DiplomaciaController::class, "create"])->name("diplomacias.create")->middleware("verified");
Route::post("/diplomacias-registrar", [DiplomaciaController::class, "store"])->name("diplomacias.store")->middleware("verified");
Route::post("/diplomacias-{id}", [DiplomaciaController::class, "update"])->name("diplomacias.update")->middleware('verified');
Route::get("/diplomacias-editar-{id}", [DiplomaciaController::class, "edit"])->name("diplomacias.edit")->middleware('verified');
Route::get("/diplomacias-eliminar-{id}", [DiplomaciaController::class, "destroy"])->name("diplomacias.destroy")->middleware('verified');


/* EXPORTACIONES */
Route::get("/exportaciones", [ExportarController::class, "index"])->name("exportar.index")->middleware("verified");
Route::get("/exportaciones-crear", [ExportarController::class, "create"])->name("exportar.create")->middleware("verified");
Route::post("/exportaciones-registrar", [ExportarController::class, "store"])->name("exportar.store")->middleware("verified");
Route::post("/exportaciones-{id}", [ExportarController::class, "update"])->name("exportar.update")->middleware('verified');
Route::get("/exportaciones-editar-{id}", [ExportarController::class, "edit"])->name("exportar.edit")->middleware('verified');
Route::get("/exportaciones-eliminar-{id}", [ExportarController::class, "destroy"])->name("exportar.destroy")->middleware('verified');
