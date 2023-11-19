<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\ProgrammersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\ToolsController;
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


Route::group(['middleware' => 'auth:sanctum'], function ($router) {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/programmers', [ProgrammersController::class, 'update']);

    Route::post('/projects', [ProjectsController::class, 'create']);
    Route::delete('/projects', [ProjectsController::class, 'delete']);

    Route::post('/skills', [SkillsController::class, 'create']);
    Route::delete('/skills', [SkillsController::class, 'delete']);

    Route::post('/tools', [ToolsController::class, 'create']);
    Route::delete('/tools', [ToolsController::class, 'delete']);

    Route::post('/experiences', [ExperiencesController::class, 'create']);
    Route::delete('/experiences', [ExperiencesController::class, 'delete']);

});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/programmers', [ProgrammersController::class, 'read']);
Route::get('/projects', [ProjectsController::class, 'read']);
Route::get('/tools', [ToolsController::class, 'read']);
Route::get('/experiences', [ExperiencesController::class, 'read']);
Route::get('/skills', [SkillsController::class, 'read']);