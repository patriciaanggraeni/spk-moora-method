@extends('layouts.app')

@section('content')
    <div class="container glassmorphism mx-auto p-4">
        <div class="col-md-7 mx-auto">
            <form method="post" action="{{ route('criteria.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-white fw-bold">Criterion Name</label>
                    <input class="form-control text-white @error('name') is-invalid @enderror" name="name" id="name"
                           placeholder="Enter an criterion name *" value="{{ old('name') ?? '' }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label text-white fw-bold">Criterion Weight</label>
                    <input class="form-control text-white @error('weight') is-invalid @enderror" name="weight"
                           id="weight" placeholder="Enter an criterion weight *" value="{{ old('weight') ?? '' }}">
                    @error('weight')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label text-white fw-bold">Criterion Type</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option>Select the criteria type *</option>
                        <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                        <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost</option>
                    </select>
                    @error('type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-light mt-5">Save</button>
            </form>
        </div>
    </div>
@endsection
