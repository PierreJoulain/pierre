<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Recette&Liste</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class=" bg-pink-50">
    <div class="px-4 mx-auto max-w-screen-xl lg:mb-16">
    @include('partials.navbar')
    @include('partials.flash-message')
    @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    @include('partials.footer')

</body>
</html>
