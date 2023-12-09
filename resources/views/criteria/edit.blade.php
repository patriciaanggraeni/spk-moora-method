@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="col-md-7 mx-auto">
            <form action="{{ $next_step }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="text-white fs-5 mb-2">Nama Kriteria:</label>
                    <input type="text" value="{{ $criteria->name }}" name="name" id="name" class="form-control" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="weight" class="text-white fs-5 mt-3 mb-2">Bobot Kriteria:</label>
                    <input type="number" equired min="0" max="99.99" step="0.01" value="{{ $criteria->weight }}" name="weight" id="weight" class="form-control" required min="0" max="99.99" step="0.01>
                </div>

                <div class="form-group">
                    <label for="type" class="text-white fs-5 mt-3 mb-2">Jenis Kriteria:</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="benefit" {{ $criteria->type == "benefit" ? "selected" : ""}}>Benefit</option>
                        <option value="cost" {{ $criteria->type == "cost" ? "selected" : "" }}>Cost</option>
                    </select>
                </div>
                    
                <button type="submit" class="btn btn-primary glassmorphism mt-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
