@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@if (session('errors'))
<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<h1 class="text-dark fw-bold my-4">Halaman Penjualan</h1>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">
    Tambah Penjualan
</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">

    <div class="input-group">

        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Search penjualan">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>

    </div>

</form>

<table class="table table-hover align-middle">

    <!-- Kepala Tabel dengan Gradasi Biru ke Hijau Pastel Kalem -->
    <thead style="border-bottom: 2px solid #dee2e6;">
        <tr style="background: linear-gradient(90deg, #cfe2ff 0%, #d1e7dd 100%) !important;">
            <th scope="col" class="py-3 ps-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">#</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Tanggal Transaksi</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Kasir</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Total Pembayaran</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Metode Pembayaran</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Status</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($sales as $sale)

        <tr>

            <th scope="row" class="ps-3">
                {{ $sales->firstItem() + $loop->index }}
            </th>

            <td class="text-secondary">
                {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
            </td>

            <td>
                {{ $sale->user->name }}
            </td>

            <td class="fw-semibold">
                Rp. {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
            </td>

            <td>
                {{ $sale->metode_pembayaran }}
            </td>

            <td>
                {{ $sale->status }}
            </td>
            <td>
                <div class="d-flex gap-1">
                    <a href="{{ route('penjualan.show', $sale->id) }}" class="btn btn-primary btn-sm fw-medium">
                        Detail
                    </a>

                    <a href="{{ route('penjualan.edit', $sale->id) }}" class="btn btn-warning btn-sm fw-medium">
                        Edit
                    </a>

                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm fw-medium" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-center py-5 text-muted">
                <h4>Data Tidak Ditemukan</h4>
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<div class="mt-3">
    {{ $sales->links() }}
</div>

@endsection