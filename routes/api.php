<?php

use App\Http\Controllers\api\ApplicationController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ProjectRoleController;
use App\Http\Controllers\api\RefferenceController;
use App\Http\Controllers\api\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

//Authentication API
// Route::get('/auth/google/redirect', [AuthController::class, 'redirectGoogle']);
// Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);

Route::post('/login', [AuthController::class, 'login'])->middleware('doNotCacheResponse');
Route::post('/register', [AuthController::class, 'register'])->middleware('doNotCacheResponse');

//User API and Refferences API
Route::middleware(['auth:sanctum', 'AuthApi'])->group(function () {
  //User API
  Route::get("/profile", [AuthController::class, "profile"])->middleware('doNotCacheResponse');
  Route::patch("/update-user", [AuthController::class, "update"])->middleware('doNotCacheResponse');
  Route::get("/logout", [AuthController::class, "logout"])->middleware('doNotCacheResponse');
  //Refferences API
  Route::get("/refferences", [RefferenceController::class, "index"]);
  Route::post("/refferences", [RefferenceController::class, "store"]);
  Route::get("/profile-refferences", [RefferenceController::class, "showByUser"]);
  Route::delete("/refferences/{id}", [RefferenceController::class, "destroy"]);
});
//Projects API
Route::get("/projects", [ProjectController::class, "index"])->middleware('cacheResponse:projects');
Route::get("/projects/search", [ProjectController::class, "search"])->middleware('cacheResponse:projects');
Route::get("/projects/{id}", [ProjectController::class, "show"]);
Route::middleware(['auth:sanctum', 'AdminAccessAPI'])->group(function () {
  Route::get("/users", [AuthController::class, "index"]);
  Route::post("/projects", [ProjectController::class, "store"]);
  Route::patch("/projects/{id}", [ProjectController::class, "update"]);
  Route::delete("/projects/{id}", [ProjectController::class, "destroy"]);
  Route::get("/projects/close-project/{id}", [ProjectController::class, "closeProject"]);
  Route::get("/projects/open-project/{id}", [ProjectController::class, "openProject"]);
});
//Application API
Route::middleware(['auth:sanctum', 'AuthApi'])->group(function () {
  //Middleware Application Owner check user->id == application->user_id
  Route::middleware(['ApplicationOwnerAPI'])->group(function () {
    Route::patch("/applications/{id}", [ApplicationController::class, "update"]);
    Route::delete("/applications/{id}", [ApplicationController::class, "destroy"]);
  });
  Route::get("/applications/handle/{id}", [ApplicationController::class, "handleApplication"])->middleware(['AdminAccessAPI']); //Untuk handle application
  Route::post("/applications", [ApplicationController::class, "store"]);
  Route::get("/applications", [ApplicationController::class, "show"]);
  Route::get("/applications/{id}", [ApplicationController::class, "showById"]);
  Route::get("/applications/user", [ApplicationController::class, "byUser"]);
});
//Company API
Route::get("/company", [CompanyController::class, "index"]);
Route::get("/company/{id}", [CompanyController::class, "show"]);
Route::middleware(['auth:sanctum', 'AdminAccessAPI'])->group(function () {
  Route::post("/company", [CompanyController::class, "store"]);
  Route::post("/company/{id}", [CompanyController::class, "update"]);
  Route::delete("/company/{id}", [CompanyController::class, "destroy"]);
});
//Roles API
Route::get("/roles", [RoleController::class, "index"]);
Route::post("/roles", [RoleController::class, "store"])->middleware(['auth:sanctum', 'AdminAccessAPI']);
//ProjectRole API
Route::get("/project-roles", [ProjectRoleController::class, "show"]);

Route::get('/test-memcached', function () {
  Cache::put('key', 'value', 10); // 10 minutes
  $value = Cache::get('key');
  return response()->json([
    'data' => $value,
    'status' => 'success',
  ]);
});

Route::get('/test-redis', function () {
  Redis::set('key', 'value');
  $value = Redis::get('key');
  return response()->json([
    'data' => $value,
    'status' => 'success',
  ]);
});
