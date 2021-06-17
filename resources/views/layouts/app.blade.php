<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/1.12.1/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')  }}">

    <!-- Fonts -->
    <link href="{{ asset('css/familyNunito.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}" defer></script>
    @yield('custom-header')
</head>
<style>
    .active {
        background-color: #6cb2eb;
    }
</style>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {!! $MyNavBar->asUl(['class' => 'navbar-nav'], ['class' => 'dropdown-menu', 'aria-labelledby'=>"navbarDropdown"]) !!}
{{--                @include(config('laravel-menu.views.bootstrap-items'), ['items' => $MyNavBar->roots()])--}}
            </div>
        </nav>
        <main class="py-4">

            @yield('content')
        </main>
    </div>
    <script>
        let basePath = '{{ url('') }}'
    </script>
    @yield('custom-js')
</body>
</html>
