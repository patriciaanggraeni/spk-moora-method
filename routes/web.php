<?php

use App\Http\Controllers\AggregateScoreController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\NormalizationController;
use App\Http\Controllers\OptimizationAttributeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria');
Route::get('/alternatives', [AlternativeController::class, 'index'])->name('alternatives');
Route::get('/decision_matrices', [DecisionMatrixController::class, 'index'])->name('decision_matrices');
Route::get('/normalizations', [NormalizationController::class, 'index'])->name('normalizations');
Route::get('/optimization_attributes', [OptimizationAttributeController::class, 'index'])
    ->name('optimization_attributes');
Route::get('/aggregate_scores', [AggregateScoreController::class, 'index'])->name('aggregate_scores');
