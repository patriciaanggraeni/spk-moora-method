@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="col-md-7 mx-auto">
            <form method="post" action="{{ route('alternative.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-white fs-5 mb-2">Nama Alternatif:</label>
                    <input type="text" name="name" id="name" class="form-control" required maxlength="255"
                    placeholder="Masukkan nama alternatif...">
                </div>

                <button type="submit" class="glassmorphism btn btn-primary mt-5">Simpan</button>
            </form>
        </div>
    </div>
@endsection
