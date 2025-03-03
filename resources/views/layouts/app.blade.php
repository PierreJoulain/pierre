<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Recette&Liste</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class=" bg-pink-50">
        @include('partials.navbar')
        @include('partials.flash-message')
        @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>

    @include('partials.footer')

</body>
</html>
