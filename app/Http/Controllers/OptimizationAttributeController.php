<?php

namespace App\Http\Controllers;

use App\Models\OptimizationAttribute;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OptimizationAttribute $optimizationAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OptimizationAttribute $optimizationAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OptimizationAttribute $optimizationAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OptimizationAttribute $optimizationAttribute)
    {
        //
    }
}
