<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Hanya tampilkan navbar jika halaman saat ini BUKAN halaman login -->
    @if(request()->routeIs('login') == false)
    @include('layouts.navbar')
    @endif

    <!-- Menambahkan mt-4 (margin-top) langsung di sini agar hanya konten yang turun ke bawah, sementara navbar tetap di atas -->
    <div class="container mt-4">

        @if(session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
        @endif

        @yield('content')
    </div>
</body>

</html>