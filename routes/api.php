<?php

use App\Http\Controllers\api\ApplicationController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ProjectRoleController;
use App\Http\Controllers\api\RefferenceController;
use App\Http\Controllers\api\RoleController;
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

//Login API
Route::get('/auth/google/redirect', [AuthController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);
//Projects API
Route::get("/projects", [ProjectController::class, "index"]);
Route::get("/projects/{id}", [ProjectController::class, "show"]);
//Roles API
Route::get("/roles", [RoleController::class, "index"]);
//ProjectRole API
Route::get("/project-roles", [ProjectRoleController::class, "show"]);
//Sanctum
Route::middleware(['auth:sanctum'])->group(function () {
  //User API
  Route::get("/profile", [AuthController::class, "profile"]);
  Route::patch("/update-user", [AuthController::class, "update"]);
  Route::get("/logout", [AuthController::class, "logout"]);
  //Refferences API
  Route::get("/refferences", [RefferenceController::class, "index"]);
  Route::get("/profile-refferences", [RefferenceController::class, "showByUser"]);
  Route::delete("/refferences/{id}", [RefferenceController::class, "destroy"]);
  //Projects API
  Route::post("/projects", [ProjectController::class, "store"]);
  Route::patch("/projects/{id}", [ProjectController::class, "update"]);
  Route::delete("/projects/{id}", [ProjectController::class, "destroy"]);
  Route::get("/projects/close-project/{id}", [ProjectController::class, "closeProject"]);
  //Application API
  Route::get("/applications", [ApplicationController::class, "show"]);
  Route::post("/applications", [ApplicationController::class, "store"]);
  Route::get("/applications/handle/{id}", [ApplicationController::class, "handleApplication"]); //Untuk handle application
  Route::patch("/applications/{id}", [ApplicationController::class, "update"]);
  Route::delete("/applications/{id}", [ApplicationController::class, "destroy"]);
});
