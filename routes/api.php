<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\datos_medicos_registrosController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group( ['middleware' => ["auth:sanctum"]], function(){
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);

    Route::post("create-Datos-Medicos", [datos_medicos_registrosController::class, "create_Datos_Medicos"]); 
    Route::get("get-datos-medicos", [datos_medicos_registrosController::class, "getDatos_Medicos"]); 
    Route::get("Datos-getBy/{id}", [datos_medicos_registrosController::class, "GetByID"]);

    Route::delete("delete-Datos-medicos/{id}", [datos_medicos_registrosController::class, "delete"]); 
    Route::put("update-Datos-Medicos/{id}", [datos_medicos_registrosController::class, "update"]); 
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
