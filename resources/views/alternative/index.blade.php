@extends('layouts.app')

@section('content')
    <a href="{{ route('alternatives.create') }}" class="btn glassmorphism text-white mb-4 p-2">
        + Add Alternative
    </a>

    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alternatives as $i => $alternative)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td class="col-md-9">{{ $alternative->name }}</td>
                        <td class="col-md-3 col-4">
                            <a href="{{ route('alternatives.edit', $alternative->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a role="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                               data-bs-target="#modalDelete" data-alternative-id="{{ $alternative->id }}">Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const alternativeId = button.getAttribute('data-alternative-id');
                    const deleteUrl = "{{ route('alternatives.destroy', '') }}/" + alternativeId;

                    document.getElementById('formDelete').setAttribute('action', deleteUrl);
                });
            });
        });
    </script>
@endpush
