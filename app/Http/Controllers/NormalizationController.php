<?php

namespace App\Http\Controllers;

use App\Models\AggregateScore;
use App\Models\Normalization;
use App\Models\OptimizationAttribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;

class NormalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->dbSeed();

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

    private function dbSeed(): void
    {
        Normalization::truncate();
        OptimizationAttribute::truncate();
        AggregateScore::truncate();

        Artisan::call('db:seed');
    }
}
