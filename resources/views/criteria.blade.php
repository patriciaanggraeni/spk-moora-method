@extends('layouts.app')

@section('content')
    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Bobot</th>
                    <th>Tipe</th>
                </tr>
                </thead>
                <tbody>
                @foreach($criteria as $i => $criterion)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $criterion->name }}</td>
                        <td>{{ $criterion->weight }}</td>
                        <td>{{ $criterion->type }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
