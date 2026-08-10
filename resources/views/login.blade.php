@vite(['resources/css/app.css', 'resources/js/app.js'])

@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- Latar belakang seluruh halaman menggunakan warna biru muda soft bawaan Bootstrap -->
<div class="vw-100 vh-100 bg-info-subtle position-fixed top-0 start-0" style="z-index: -1;"></div>

<div class="card text-center position-absolute top-50 start-50 translate-middle shadow border-0" style="width: 22rem; border-radius: 12px; overflow: hidden;">
    <!-- Header menggunakan warna biru muda soft dengan teks biru tua -->
    <h5 class="card-header bg-info text-dark fw-bold py-3 border-0">Login POS</h5>

    <!-- MENGUBAH BACKGROUND BADAN KOTAK MENJADI BIRU MUDA (bg-light atau bg-info-subtle) -->
    <div class="card-body p-4 bg-light bg-opacity-75">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label fw-semibold text-secondary">Email address</label>
                <!-- Input menggunakan background putih bersih agar tulisan tetap tajam dibaca -->
                <input type="email" name="email" class="form-control border-info-subtle bg-white"
                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan email Anda" required>
                @error('email')
                <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 text-start">
                <label for="exampleInputPassword1" class="form-label fw-semibold text-secondary">Password</label>
                <input type="password" name="password" class="form-control border-info-subtle bg-white" id="exampleInputPassword1" placeholder="Masukkan password" required>
                @error('password')
                <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tombol submit menggunakan warna biru soft yang sedikit lebih tegas -->
            <button type="submit" class="btn btn-info text-dark w-100 fw-bold py-2 shadow-sm">Submit</button>
        </form>
    </div>
</div>

@endsection