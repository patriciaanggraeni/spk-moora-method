@extends('layouts.app')

@section('content')
    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>A/C</th>
                    @for($i = 1; $i <= $criteriaLength; $i++)
                        <th>C{{ $i }}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @foreach($normalizations as $i => $cell)
                    <tr>
                        <td class="fw-bold">A{{ $i }}</td>
                        @foreach($cell as $c)
                            <td>{{ $c->value }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
