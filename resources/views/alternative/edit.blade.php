@extends('layouts.app')

@section('content')
    <div class="container glassmorphism mx-auto p-4">
        <div class="col-md-7 mx-auto">
            <form method="post"
                  action="{{ route('alternatives.update', ['alternative' => $decisionMatrices->first()->alternative->id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-white fw-bold">Alternative Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                           placeholder="Enter an alternative name *"
                           value="{{ old('name') ?? $decisionMatrices->first()->alternative->name }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @foreach($decisionMatrices as $matrix)
                    <div class="mb-3">
                        <label for="criterion_{{ $matrix->criterion->id }}" class="form-label text-white fw-bold">
                            Value for {{ $matrix->criterion->name }}
                        </label>
                        <input
                            class="form-control @error('criterion_' . $matrix->criterion->id) is-invalid @enderror"
                            name="criterion_{{ $matrix->criterion->id }}"
                            id="criterion_{{ $matrix->criterion->id }}" placeholder="Enter a criterion value *"
                            value="{{ old('criterion_' . $matrix->criterion->id) ?? $matrix->value }}">
                        @error('criterion_' . $matrix->criterion->id)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endforeach

                @foreach($newCriteria as $criterion)
                    <div class="mb-3">
                        <label for="criterion_{{ $criterion->id }}" class="form-label text-white fw-bold">
                            Value for {{ $criterion->name }}
                        </label>
                        <input
                            class="form-control text-white @error('criterion_' . $criterion->id) is-invalid @enderror"
                            name="criterion_{{ $criterion->id }}" id="criterion_{{ $criterion->id }}"
                            placeholder="Enter a criterion value *"
                            value="{{ old('criterion_' . $criterion->id, $decisionMatrices->where('criterion_id', $criterion->id)->first()->value ?? '') }}">
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
