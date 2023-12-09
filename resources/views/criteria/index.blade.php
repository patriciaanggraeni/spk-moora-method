@extends('layouts.app')

@section('content')

    <button onclick="window.location='{{ route('criteria.create') }}'" class="glassmorphism text-white mb-4 p-2">+ Tambah Kriteria</button>

    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Bobot</th>
                    <th>Tipe</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($criteria as $i => $criterion)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $criterion->name }}</td>
                        <td>{{ $criterion->weight }}</td>
                        <td>{{ $criterion->type }}</td>
                        <td>
                            <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('criteria.destroy', $criterion->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
