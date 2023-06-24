<?php
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\TipoDocController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("v1/documentos",DocumentosController::class);
//Route::post("v1/postDocumetos",[DocumentosController::class,'store']);
Route::get("v1/proprocesos",[DocumentosController::class,'listaProcesos']);
Route::get("v1/tipodocs",[DocumentosController::class,'listaTipoDocs']);
Route::apiResource("v1/usuarios",UserController::class);
Route::post("v1/login",[UserController::class,'login']);

