@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="padding-top: 2rem;">
    <!-- Judul Halaman beserta Tombol Logout -->
    <div class="mb-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #bae6fd; padding-bottom: 0.5rem;">
        <h1 class="h3 font-weight-bold" style="color: #0369a1; margin: 0;">Tentang Saya</h1>

        <!-- Kartu Profil -->
        <div class="card shadow-sm border" style="background: #ffffff; border-radius: 8px; border: 1px solid #dee2e6; padding: 30px;">
            <div class="card-body">
                <h2 class="h5 font-weight-bold text-dark mb-4">Profil Saya</h2>

                <div class="row">
                    <!-- Nama Lengkap -->
                    <div class="col-md-6 mb-3">
                        <div class="p-3" style="background: #fce7f3; border-radius: 6px; border: 1px solid #fbcfe8;">
                            <span style="font-size: 0.75rem; font-weight: 600; color: #be185d; text-transform: uppercase; display: block;">Nama Lengkap</span>
                            <span style="font-size: 1rem; font-weight: 500; color: #831843; display: block; margin-top: 2px;">Dian Nurramadhan</span>
                        </div>
                    </div>

                    <!-- Kelas -->
                    <div class="col-md-6 mb-3">
                        <div class="p-3" style="background: #e0f2fe; border-radius: 6px; border: 1px solid #bae6fd;">
                            <span style="font-size: 0.75rem; font-weight: 600; color: #0369a1; text-transform: uppercase; display: block;">Kelas</span>
                            <span style="font-size: 1rem; font-weight: 500; color: #0c4a6e; display: block; margin-top: 2px;"> XII PPLG 3</span>
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-md-6 mb-3">
                        <div class="p-3" style="background: #dcfce7; border-radius: 6px; border: 1px solid #bbf7d0;">
                            <span style="font-size: 0.75rem; font-weight: 600; color: #15803d; text-transform: uppercase; display: block;">Tanggal Lahir</span>
                            <span style="font-size: 1rem; font-weight: 500; color: #14532d; display: block; margin-top: 2px;">01 September 2008</span>
                        </div>
                    </div>

                    <!-- Asal Sekolah -->
                    <div class="col-md-6 mb-3">
                        <div class="p-3" style="background: #f3e8ff; border-radius: 6px; border: 1px solid #e9d5ff;">
                            <span style="font-size: 0.75rem; font-weight: 600; color: #7e22ce; text-transform: uppercase; display: block;">Asal Sekolah</span>
                            <span style="font-size: 1rem; font-weight: 500; color: #581c87; display: block; margin-top: 2px;">SMKN 4 Tasikmalaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection