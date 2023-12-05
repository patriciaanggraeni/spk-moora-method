@extends('layouts.app')

@section('content')
    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>A/C</th>
                    <th>Maximum</th>
                    <th>Minimum</th>
                    <th>Max - Min</th>
                    <th>Ranking</th>
                </tr>
                </thead>
                <tbody>
                @foreach($aggregateScores as $i => $cell)
                    <tr>
                        <td class="fw-bold">A{{ $i+1 }}</td>
                        <td>{{ $alternatives[$i+1]['totalBenefit'] }}</td>
                        <td>{{ $alternatives[$i+1]['totalCost'] }}</td>
                        <td>{{ $cell->value }}</td>
                        <td>{{ $ranking[$i] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
