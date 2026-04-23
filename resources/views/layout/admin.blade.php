<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'App')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.navbarAdmin')
    <main class="w-full">
        @yield('content')
    </main>
     <!-- FOOTER -->
    <!-- <footer class="bg-purple-600 text-white text-center py-4">
        Kita Butuh Peta
    </footer> -->

    <footer style="background-color:#a099ff; padding:20px; display:none;">
        <p style="text-align:center;">Kita Butuh Peta</p>
    </footer>

    @stack('scripts')
</body>
</html>
