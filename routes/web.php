<?php

use App\Http\Controllers\AggregateScoreController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

// --- Kriteria
Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
Route::get('/criteria/create', [CriteriaController::class, 'create'])->name('criteria.create');
Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
Route::get('/criteria/{criteria}/edit', [CriteriaController::class, 'edit'])->name('criteria.edit');
Route::put('/criteria/{criteria}/update', [CriteriaController::class, 'update'])->name('criteria.update');
Route::delete('/criteria/{criteria}', [CriteriaController::class, 'destroy'])->name('criteria.destroy');

// --- Alternatif
Route::get('/alternatives', [AlternativeController::class, 'index'])->name('alternative.index');
Route::get('/alternative/create', [AlternativeController::class, 'create'])->name('alternative.create');
Route::post('/alternative', [AlternativeController::class, 'store'])->name('alternative.store');
Route::get('/alternative/{alternative}/edit', [AlternativeController::class, 'edit'])->name('alternative.edit');
Route::put('/alternative/{alternative}/update', [AlternativeController::class, 'update'])->name('alternative.update');
Route::delete('/alternative/{alternative}', [AlternativeController::class, 'destroy'])->name('alternative.destroy');

Route::get('/decision_matrices', [DecisionMatrixController::class, 'index'])->name('decision_matrices');
Route::get('/normalizations', [NormalizationController::class, 'index'])->name('normalizations');
Route::get('/optimization_attributes', [OptimizationAttributeController::class, 'index'])
    ->name('optimization_attributes');
Route::get('/aggregate_scores', [AggregateScoreController::class, 'index'])->name('aggregate_scores');
