<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("users", [UserController::class, "index"]);
Route::post("users", [UserController::class, "store"]);
Route::get("users/{id}", [UserController::class, "show"]);
Route::put("users/{id}", [UserController::class, "update"]);
Route::delete("users/{id}", [UserController::class, "destroy"]);


Route::get("employee", [EmployeeController::class, "index"]);
Route::post("employee", [EmployeeController::class, "store"]);
Route::get("employee/{id}", [EmployeeController::class, "show"]);
Route::put("employee/{id}", [EmployeeController::class, "update"]);
Route::delete("employee/{id}", [EmployeeController::class, "destroy"]);

// Jakol ka muna 3x a day!!