@extends('layouts.app')

@section('content')
    <a href="{{ route('criteria.create') }}" class="btn glassmorphism text-white mb-4 p-2">
        + Add Criterion
    </a>

    <div class="glassmorphism p-2">
        <div class="table-responsive">
            <table class="table table-transparent table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Weight</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($criteria as $i => $criterion)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td class="col-md-5">{{ $criterion->name }}</td>
                        <td class="col-md-2">{{ $criterion->weight }}</td>
                        <td class="col-md-2">{{ $criterion->type }}</td>
                        <td class="col-md-3 col-4">
                            <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a role="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                               data-bs-target="#modalDelete" data-criterion-id="{{ $criterion->id }}">Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-3">Are you sure you want to delete?</h5>
                </div>
                <form class="modal-footer flex-nowrap p-0" id="formDelete" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                            data-bs-dismiss="modal">Yes, delete
                    </button>
                    <button type="button"
                            class="btn btn-lg btn-link fs-6 text-dark text-decoration-none col-6 py-3 m-0 rounded-0"
                            data-bs-dismiss="modal"><strong>Cancel</strong>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const criterionId = button.getAttribute('data-criterion-id');
                    const deleteUrl = "{{ route('criteria.destroy', '') }}/" + criterionId;

                    console.log(deleteUrl);

                    document.getElementById('formDelete').setAttribute('action', deleteUrl);
                });
            });
        });
    </script>
@endpush
