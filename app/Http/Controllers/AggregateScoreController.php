<?php

namespace App\Http\Controllers;

use App\Models\AggregateScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AggregateScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $alternatives = AggregateScore::calculateAndGetAggregateScores();
        $aggregateScores = AggregateScore::all();

//        dd($alternatives, array($aggregateScores));

        return view('aggregate-scores')->with([
            'title' => 'Aggregate Scores',
            'prev_step' => route('optimization_attributes'),
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
}
