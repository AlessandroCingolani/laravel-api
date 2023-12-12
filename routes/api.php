<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;

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

Route::get('/projects', [PageController::class, 'index']);

Route::get('/technologies', [PageController::class, 'getTechs']);

Route::get('/types', [PageController::class, 'getTypes']);

Route::get('/projects-by-type/{type_slug}', [PageController::class, 'getProjectsByType']);
Route::get('/projects-by-technology/{technology_slug}', [PageController::class, 'getProjectsByTech']);
Route::get('/projects/research/{tosearch}', [PageController::class, 'searchProjects']);

Route::get('/projects/get-project/{slug}', [PageController::class, 'getSlugProject']);
