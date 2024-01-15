@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Halaman Satu</h2>
        
        @if ($user)
        <div class="mb-3">
            <strong>NISN:</strong> {{ $user->nisn }}
        </div>
            <div class="mb-3">
                <strong>Nama:</strong> {{ $user->nama }}
            </div>
            <div class="mb-3">
                <strong>Kelas:</strong> {{ $user->kelas }}
            </div>
            <div class="mb-3">
                <strong>No. Absen:</strong> {{ $user->no_absen }}
            </div>
        @endif

        <!-- Konten halaman satu di sini -->

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection

