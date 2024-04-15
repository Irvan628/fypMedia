<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>