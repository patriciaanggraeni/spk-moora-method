@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('criteria.store') }}">
            @csrf
            <div class="form-group">
                <label for="name" class="text-white fs-5 mb-2">Nama Kriteria:</label>
                <input type="text" name="name" id="name" class="form-control" required maxlength="255"
                placeholder="Masukkan nama kriteria...">
            </div>

            <div class="form-group">
                <label for="weight" class="text-white fs-5 mt-3 mb-2">Bobot Kriteria:</label>
                <input type="number" name="weight" id="weight" class="form-control" required min="0" max="99.99" step="0.01"
                placeholder="Masukkan jumlah bobot...">
            </div>

            <div class="form-group">
                <label for="type" class="text-white fs-5 mt-3 mb-2">Jenis Kriteria:</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="" disabled selected>--Pilih jenis kriteria--</option>
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>
            </div>

            <button type="submit" class="glassmorphism btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection
