<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tambahkan link ke file Bootstrap CSS -->
    <link href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Tambahkan CSS kustom atau file eksternal lainnya jika diperlukan -->

    <!-- Tambahkan skrip skrip yang diperlukan di bagian head -->
    <!-- Contoh: <script src="{{ asset('js/app.js') }}" defer></script> -->
</head>
<body>

    <div id="app">
        <!-- Bagian konten aplikasi akan dimasukkan di sini -->
        @yield('content')
    </div>

    <!-- Tambahkan link ke file Bootstrap JavaScript (Popper.js diperlukan oleh beberapa komponen Bootstrap) -->
    <script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Tambahkan skrip skrip yang diperlukan sebelum tag penutup body -->
    <!-- Contoh: <script src="{{ asset('js/app.js') }}" defer></script> -->
</body>
</html>
