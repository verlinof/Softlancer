<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProjectController;
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

Route::get('/auth/google/redirect', [AuthController::class, 'redirectGoogle']);

Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);

Route::get("/logout", [AuthController::class, "logout"])->middleware(["auth:sanctum"]);

//Projects API
Route::get("/projects", [ProjectController::class, "index"]);

Route::get("/projects/{id}", [ProjectController::class, "show"]);

Route::post("/projects", [ProjectController::class, "store"]);

Route::get("/projects/close-project/{id}", [ProjectController::class, "closeProject"]);
