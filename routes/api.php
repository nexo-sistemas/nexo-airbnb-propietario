<?php

use App\Http\Controllers\PropietarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login/propietario', [PropietarioController::class, 'login_propietario']);
Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/unidades/{uuidUsuario}/{entidadID}', [PropietarioController::class, 'unidadXEntidad']);
    Route::post('/ficha', [PropietarioController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
