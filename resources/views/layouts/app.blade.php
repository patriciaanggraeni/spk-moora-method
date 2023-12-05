<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel')}} | {{ $title }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=Nunito">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <h3 class="text-center text-white">{{ $title }}</h3>

            <div class="my-5">
                @yield('content')
            </div>

            <div class="w-100 d-flex justify-content-between">
                <a href="{{ $prev_step }}" class="text-decoration-none text-white glassmorphism p-2">
                    Prev Step
                </a>
                <a href="{{ $next_step }}" class="text-decoration-none text-white glassmorphism p-2">
                    Next Step
                </a>
            </div>
        </div>
</main>

<script src="https://kit.fontawesome.com/51ab965bab.js" crossorigin="anonymous"></script>
</div>
</body>
</html>
