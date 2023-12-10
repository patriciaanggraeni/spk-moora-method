<?php

namespace App\Http\Controllers;

use App\Models\OptimizationAttribute;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class OptimizationAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $criteriaLength = OptimizationAttribute::distinct('criterion_id')->count('criterion_id');
        $optimizationAttributes = OptimizationAttribute::all()->groupBy('alternative_id');

        return view('optimization-attributes')->with([
            'title' => 'Optimization Attributes',
            'prev_step' => route('normalizations'),
            'next_step' => route('aggregate_scores'),
            'criteriaLength' => $criteriaLength,
            'optimizationAttributes' => $optimizationAttributes,
        ]);
    }
}
