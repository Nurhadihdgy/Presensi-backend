@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Registration Form</h2>

        <!-- Tambahkan alert untuk menampilkan pesan -->
        <div id="registrationAlert" class="alert d-none" role="alert"></div>

        <form id="registrationForm" action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" name="nisn" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas:</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="no_absen" class="form-label">Nomor Absen:</label>
                <input type="text" name="no_absen" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <!-- Tambahkan skrip JavaScript untuk menangani registrasi -->
    <script>
        /// Tampilkan pesan respons dalam alert setelah registrasi berhasil
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
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
            // Tampilkan pesan respons dalam alert
            const alertElement = document.getElementById('registrationAlert');
            alertElement.textContent = data.message;
            alertElement.classList.remove('d-none');
            alertElement.classList.add('alert-success');

            // Tambahkan delay (misalnya, 3 detik) sebelum mengalihkan kembali ke halaman registrasi
            setTimeout(function () {
                window.location.href = '{{ route('login') }}';
            }, 1000); // Delay dalam milidetik (3 detik dalam contoh ini)
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
@endsection
