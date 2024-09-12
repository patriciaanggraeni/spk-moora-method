<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel')}} | {{ $title }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=Nunito">
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <h3 class="text-center text-white">{{ $title }}</h3>
            <div class="my-5">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <div class="w-100 d-flex justify-content-between">
                @if(isset($prev_step))
                    <a href="{{ $prev_step }}" class="text-decoration-none text-white glassmorphism p-2">
                        Prev Step
                    </a>
                @else
                    <div></div>
                @endif
                @if(isset($next_step))
                    <a href="{{ $next_step }}" class="text-decoration-none text-white glassmorphism p-2">
                        Next Step
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </main>

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

    @stack('script')
</div>
</body>
</html>
