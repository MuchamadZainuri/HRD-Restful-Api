<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EmployeeStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// route auth:sanctum dan digrup untuk proteksi semua route yang ada di dalamnya
Route::middleware(['auth:sanctum'])->group(function () {

// route untuk menampilkan semau data employees
Route::get("employees", [EmployeesController::class, "index"]);

// route untuk menambahkan data employees
Route::post("employees", [EmployeesController::class, "store"]);

// route untuk menampilkan data employees berdasarkan id
Route::get("employees/{id}", [EmployeesController::class, "show"]);

// route untuk mengupdate data employees
Route::put("employees/{id}", [EmployeesController::class, "update"]);

// route untuk menghapus data employees
Route::delete("employees/{id}", [EmployeesController::class, "destroy"]);

// route untuk menampilkan data employees berdasarkan name
Route::get("employees/search/{name}", [EmployeesController::class, "search"]);

// route untuk menampilkan data employees berdasarkan status:active
Route::get("employees/status/active", [EmployeesController::class, "active"]);

// route untuk menampilkan data employees berdasarkan status:inactive
Route::get("employees/status/inactive", [EmployeesController::class, "inactive"]);

// route untuk menampilkan data employees berdasarkan status:terminated
Route::get("employees/status/terminated", [EmployeesController::class, "terminated"]);

});

// route untuk register
Route::post("register", [AuthController::class, "register"]);

// route untuk login
Route::post("login", [AuthController::class, "login"]);

