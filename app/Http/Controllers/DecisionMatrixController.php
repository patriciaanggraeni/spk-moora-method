<?php

namespace App\Http\Controllers;

use App\Models\DecisionMatrix;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DecisionMatrixController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $criteriaLength = DecisionMatrix::distinct('criterion_id')->count('criterion_id');
        $decisionMatrices = DecisionMatrix::all()->groupBy('alternative_id');

        return view('decision-matrices')->with([
            'title' => 'Decision Matrices',
            'prev_step' => route('alternatives.index'),
            'next_step' => route('normalizations'),
            'criteriaLength' => $criteriaLength,
            'decisionMatrices' => $decisionMatrices,
        ]);
    }
}
