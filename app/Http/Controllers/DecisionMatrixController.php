<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\DecisionMatrix;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DecisionMatrixController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $criteriaLength = DecisionMatrix::distinct('criterion_id')->count('criterion_id');
        $decisionMatrices = DecisionMatrix::all()->groupBy('alternative_id');

        return view('decision-matrices')->with([
            'title' => 'Decision Matrices',
            'prev_step' => route('alternatives'),
            'next_step' => route('normalizations'),
            'criteriaLength' => $criteriaLength,
            'decisionMatrices' => $decisionMatrices,
        ]);
    }
}
