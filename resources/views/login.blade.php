@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Login Form</h2>

        <!-- Tambahkan alert untuk menampilkan pesan -->
        <div id="loginAlert" class="alert d-none" role="alert"></div>

        <form id="loginForm" action="{{ route('login') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" name="nisn" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Tambahkan skrip JavaScript untuk menangani login -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();

            fetch(this.action, {
                method: this.method,
                body: new URLSearchParams(new FormData(this)),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(response => response.json())
            .then(data => {
                const alertElement = document.getElementById('loginAlert');
                alertElement.textContent = data.message;
                alertElement.classList.remove('d-none');

                // Tambahkan delay (misalnya, 3 detik) sebelum mengalihkan kembali ke halaman registrasi
            setTimeout(function () {
                window.location.href = '{{ route('page.one') }}';
            }, 1000); // Delay dalam milidetik (3 detik dalam contoh ini)
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
@endsection
