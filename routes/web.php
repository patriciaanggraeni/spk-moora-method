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

// --- Kriteria
Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
Route::get('/criteria/create', [CriteriaController::class, 'create'])->name('criteria.create');
Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
Route::get('/criteria/{criteria}/edit', [CriteriaController::class, 'edit'])->name('criteria.edit');
Route::put('/criteria/{criteria}/update', [CriteriaController::class, 'update'])->name('criteria.update');
Route::delete('/criteria/{criteria}', [CriteriaController::class, 'destroy'])->name('criteria.destroy');

// --- Alternatif
Route::get('/alternative', [AlternativeController::class, 'index'])->name('alternatives.index');
Route::get('/alternative/create', [AlternativeController::class, 'create'])->name('alternatives.create');
Route::post('/alternative', [AlternativeController::class, 'store'])->name('alternatives.store');
Route::get('/alternative/{alternative}/edit', [AlternativeController::class, 'edit'])->name('alternatives.edit');
Route::put('/alternative/{alternative}/update', [AlternativeController::class, 'update'])->name('alternatives.update');
Route::delete('/alternative/{alternative}', [AlternativeController::class, 'destroy'])->name('alternatives.destroy');

Route::get('/decision_matrix', [DecisionMatrixController::class, 'index'])->name('decision_matrices');
Route::get('/normalization', [NormalizationController::class, 'index'])->name('normalizations');
Route::get('/optimization_attribute', [OptimizationAttributeController::class, 'index'])
    ->name('optimization_attributes');
Route::get('/aggregate_score', [AggregateScoreController::class, 'index'])->name('aggregate_scores');
