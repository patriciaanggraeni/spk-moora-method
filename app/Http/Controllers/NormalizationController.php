<?php

namespace App\Http\Controllers;

use App\Models\Normalization;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NormalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $criteriaLength = Normalization::distinct('criterion_id')->count('criterion_id');
        $normalizations = Normalization::all()->groupBy('alternative_id');

        return view('normalizations')->with([
            'title' => 'Normalizations',
            'prev_step' => route('decision_matrices'),
            'next_step' => route('optimization_attributes'),
            'criteriaLength' => $criteriaLength,
            'normalizations' => $normalizations,
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
    public function show(Normalization $normalization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Normalization $normalization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Normalization $normalization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Normalization $normalization)
    {
        //
    }
}
