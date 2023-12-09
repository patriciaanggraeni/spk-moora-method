@extends('layouts.app')

@section('content')
    <button onclick="window.location='{{ route('alternative.create') }}'" class="glassmorphism text-white mb-4 p-2">+ Tambah Alternatif</button>

    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alternatives as $i => $alternative)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td class="col-md-10">{{ $alternative->name }}</td>
                        <td>
                            <a href="{{ route('alternative.edit', $alternative->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('alternative.destroy', $alternative->id) }}" method="post" style="display: inline-block;">
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
