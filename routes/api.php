<?php

use App\Http\Controllers\api\ApplicationController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ProjectRoleController;
use App\Http\Controllers\api\RefferenceController;
use App\Http\Controllers\api\RoleController;
use Illuminate\Support\Facades\Route;

//Authentication API
Route::get('/auth/google/redirect', [AuthController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);
//Projects API
Route::get("/projects", [ProjectController::class, "index"]);
Route::get("/projects/{id}", [ProjectController::class, "show"]);
Route::middleware(['auth:sanctum', 'AdminAccessAPI'])->group(function () {
  Route::post("/projects", [ProjectController::class, "store"]);
  Route::patch("/projects/{id}", [ProjectController::class, "update"]);
  Route::delete("/projects/{id}", [ProjectController::class, "destroy"]);
  Route::get("/projects/close-project/{id}", [ProjectController::class, "closeProject"]);
  Route::get("/projects/open-project/{id}", [ProjectController::class, "openProject"]);
});
//Application API
Route::middleware(['auth:sanctum'])->group(function () {
  //Middleware Application Owner check user->id == application->user_id
  Route::middleware(['ApplicationOwnerAPI'])->group(function () {
    Route::patch("/applications/{id}", [ApplicationController::class, "update"]);
    Route::delete("/applications/{id}", [ApplicationController::class, "destroy"]);
  });
  Route::get("/applications/handle/{id}", [ApplicationController::class, "handleApplication"])->middleware(['AdminAccessAPI']); //Untuk handle application
  Route::post("/applications", [ApplicationController::class, "store"]);
  Route::get("/applications", [ApplicationController::class, "show"]);
});
//Company API
Route::get("/company", [CompanyController::class, "index"]);
Route::get("/company/{id}", [CompanyController::class, "show"]);
Route::middleware(['auth:sanctum', 'AdminAccessAPI'])->group(function () {
  Route::post("/company", [CompanyController::class, "store"]);
  Route::patch("/company/{id}", [CompanyController::class, "update"]);
  Route::delete("/company/{id}", [CompanyController::class, "destroy"]);
});
//User API and Refferences API
Route::middleware(['auth:sanctum'])->group(function () {
  //User API
  Route::get("/profile", [AuthController::class, "profile"]);
  Route::patch("/update-user", [AuthController::class, "update"]);
  Route::get("/logout", [AuthController::class, "logout"]);
  //Refferences API
  Route::get("/refferences", [RefferenceController::class, "index"]);
  Route::post("/refferences", [RefferenceController::class, "store"]);
  Route::get("/profile-refferences", [RefferenceController::class, "showByUser"]);
  Route::delete("/refferences/{id}", [RefferenceController::class, "destroy"]);
});
//Roles API
Route::get("/roles", [RoleController::class, "index"]);
Route::post("/roles", [RoleController::class, "store"])->middleware(['auth:sanctum', 'AdminAccessAPI']);
//ProjectRole API
Route::get("/project-roles", [ProjectRoleController::class, "show"]);
