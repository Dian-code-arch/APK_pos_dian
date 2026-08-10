@extends('layouts.app')

@section('title', 'Login')

@section('content')

@include('layouts.navbar')

<div class="text-center">
    <h1>
        Ringkasan Hari Ini
        <small class="text-muted">
            ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
        </small>
    </h1>
    <div class="row">
        @can('viewAny', App\Models\User::class)
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>

        <!-- 1. Total Nilai Penjualan Hari Ini (WARNA BIRU) -->
        <div class="col-md-6 mb-3">
            <div class="card bg-primary-subtle text-primary-emphasis border-primary-subtle">
                <div class="card-header fw-bold">
                    Total Nilai Penjualan Hari Ini
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                </div>
            </div>
        </div>

        <!-- 2. Jumlah Transaksi Hari Ini (WARNA HIJAU) -->
        <div class="col-md-6 mb-3">
            <div class="card bg-success-subtle text-success-emphasis border-success-subtle">
                <div class="card-header fw-bold">
                    Jumlah Transaksi Hari Ini
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $ringkasan['total_transaksi'] }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>

        <!-- 3. Total Pembayaran Tunai (WARNA KUNING) -->
        <div class="col-md-6 mb-3">
            <div class="card bg-warning-subtle text-warning-emphasis border-warning-subtle">
                <div class="card-header fw-bold">
                    Total Pembayaran Tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rp {{ number_format($ringkasan['total_cash']) }}</h5>
                </div>
            </div>
        </div>

        <!-- 4. Total Pembayaran Non-Tunai (WARNA CYAN/BIRU MUDA) -->
        <div class="col-md-6 mb-3">
            <div class="card bg-info-subtle text-info-emphasis border-info-subtle">
                <div class="card-header fw-bold">
                    Total Pembayaran Non-Tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!-- BAGIAN YANG DITAMBAHKAN WARNA DAN STRUKTUR CARD AGAR RAPI -->
    <div class="row mt-4 text-start">
        <div class="col-md-12 text-center mb-3">
            <h1 class="fw-bold">Critical Inventory Status</h1>
        </div>

        <!-- Tabel Produk Stok Rendah (Kuning) -->
        <div class="col-md-6 mb-4">
            <div class="card border-warning-subtle shadow-sm">
                <div class="card-header bg-warning-subtle text-warning-emphasis fw-bold">
                    Daftar Produk Stok Rendah
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-warning text-warning-emphasis">
                            <tr>
                                <th scope="col" class="ps-3">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col" class="pe-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <td class="ps-3">{{ $produkStokRendah->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td class="pe-3"><span class="badge bg-warning text-dark px-2.5 py-1">{{ $produk->stok }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($produkStokRendah->hasPages())
                <div class="card-footer bg-white border-0">
                    {{ $produkStokRendah->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Tabel Produk Habis (Merah) -->
        <div class="col-md-6 mb-4">
            <div class="card border-danger-subtle shadow-sm">
                <div class="card-header bg-danger-subtle text-danger-emphasis fw-bold">
                    Daftar Produk Habis
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-danger text-danger-emphasis">
                            <tr>
                                <th scope="col" class="ps-3">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col" class="pe-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <td class="ps-3">{{ $produkStokHabis->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td class="pe-3"><span class="badge bg-danger px-2.5 py-1">{{ $produk->stok }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($produkStokHabis->hasPages())
                <div class="card-footer bg-white border-0">
                    {{ $produkStokHabis->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tabel Best Seller Products (Hijau) -->
    <div class="row mt-2 text-start">
        <div class="col-md-12 text-center mb-3">
            <h1 class="fw-bold">Best Seller Products</h1>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card border-success-subtle shadow-sm">
                <div class="card-header bg-success-subtle text-success-emphasis fw-bold">
                    Produk Paling Laris
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-success text-success-emphasis">
                            <tr>
                                <th scope="col" class="ps-4">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col" class="pe-4">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td class="pe-4"><span class="badge bg-success px-3 py-1.5">{{ $produk->total_terjual }} Unit</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection