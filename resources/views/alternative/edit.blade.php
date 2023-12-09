@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="col-md-7 mx-auto">
            <form action="{{ $next_step }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="text-white fs-5 mb-2">Nama Alternative:</label>
                    <input type="text" value="{{ $alternative->name }}" name="name" id="name" class="form-control" required maxlength="255">
                </div>

                <button type="submit" class="btn btn-primary glassmorphism mt-5">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
