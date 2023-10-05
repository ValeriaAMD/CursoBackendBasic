<?php

use App\Http\Controllers\AuthController;
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


Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello World!',
    ]);
});

Route::post('/crear_usuario', [UserController::class,'crear_usuario']);
Route::post('/iniciar_secion', [AuthController::class, 'iniciar_secion']);
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/obtener_token', [UserController::class, 'obtener_usuario_por_token']);
    Route::get('/consultar_usuario/{usuario_id}', [UserController::class, 'consultar_usuario']);
});
