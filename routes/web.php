<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[CrudController::class, "index"])->name("crud.index");

// Ruta para nuevo producto
Route::post("/registrar-producto",[CrudController::class, "create"])->name("crud.create");

// Ruta para modificar producto
Route::post("/modificar-producto",[CrudController::class, "update"])->name("crud.update");

// Ruta para eliminar producto
Route::get("/eliminar-producto-{id}",[CrudController::class, "delete"])->name("crud.delete");