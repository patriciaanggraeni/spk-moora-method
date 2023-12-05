@extends('layouts.app')

@section('content')
    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alternatives as $i => $alternative)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $alternative->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
