<?php

namespace App\Http\Controllers;

use App\Models\AggregateScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AggregateScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $alternatives = AggregateScore::calculateAndGetAggregateScores();
        $aggregateScores = AggregateScore::all();

        return view('aggregate-scores')->with([
            'title' => 'Aggregate Scores',
            'prev_step' => route('optimization_attributes'),
            'next_step' => route('home'),
            'alternatives' => $alternatives,
            'aggregateScores' => $aggregateScores,
            'ranking' => self::getRank(),
        ]);
    }

    private static function getRank(): array
    {
        $scores = AggregateScore::pluck('value')->toArray();
        $scoresDesc = collect($scores)->sortDesc()->values()->all();

        $result = [];
        foreach ($scores as $i => $score) {
            $indexInSortedArray = array_search($score, $scoresDesc);
            $result[$i] = $indexInSortedArray + 1;
        }
        return $result;
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
    public function show(AggregateScore $aggregateScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AggregateScore $aggregateScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AggregateScore $aggregateScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AggregateScore $aggregateScore)
    {
        //
    }
}
