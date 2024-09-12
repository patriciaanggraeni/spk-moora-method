@extends('layouts.app')

@section('content')
    <div class="container glassmorphism mx-auto p-4">
        <div class="col-md-7 mx-auto">
            <form method="post" action="{{ route('alternatives.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-white fw-bold">Alternative Name</label>
                    <input class="form-control text-white @error('name') is-invalid @enderror" name="name" id="name"
                           placeholder="Enter an alternative name *" value="{{ old('name') ?? '' }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @foreach($criteria as $criterion)
                    <div class="mb-3">
                        <label for="criterion_{{ $criterion->id }}" class="form-label text-white fw-bold">
                            Value for {{ $criterion->name }}
                        </label>
                        <input
                            class="form-control @error('criterion_' . $criterion->id) is-invalid @enderror"
                            name="criterion_{{ $criterion->id }}" id="criterion_{{ $criterion->id }}"
                            placeholder="Enter a criterion value *" value="{{ old('criterion_' . $criterion->id) }}">
                        @error('criterion_' . $criterion->id)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn btn-light mt-5">Save</button>
            </form>
        </div>
    </div>
@endsection
