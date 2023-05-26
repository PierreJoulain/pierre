<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>zizi</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    @include('partials.navbar')
    @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
