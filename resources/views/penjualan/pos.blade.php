@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@if(session('errors'))

<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<h4 class="mb-3">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>

<div class="row">

    {{-- ================== PRODUK ================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">
                <div class="mb-3">
                    <form method="GET" action="{{ route('penjualan.create') }}">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari produk..."
                            onkeyup="this.form.submit()">
                    </form>
                </div>

                @foreach ($products as $product)
                <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="col-7">
                        <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                            <div class="d-flex align-items-center gap-2">

                                {{-- Nama & harga --}}
                                <div>
                                    <div class="fw-semibold">
                                        {{ $product->nama }}
                                    </div>

                                    <small class="text-muted">
                                        {{ number_format($product->harga_jual) }}
                                    </small>
                                </div>

                            </div>

                        </button>
                    </div>

                    <div class="col-3">
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                    </div>

                    <div class="col-2">
                        <button class="btn btn-primary w-100">+</button>
                    </div>

                </form>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ===================== KERANJANG ===================== --}}
    <div class="col-md-6">
        <div class="card">
            <table class="table table-bordered mb-0">

                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($sale->itemPenjualan as $item)

                    <!-- Baris diberi class dan data attribute untuk kebutuhan hitung instan JavaScript -->
                    <tr class="cart-row" data-id="{{ $item->id }}" data-harga="{{ $item->produk->harga_jual }}">

                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp. {{ number_format($item->produk->harga_jual) }}</td>

                        <td>
                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}" class="qty-form">
                                @csrf
                                @method('PUT')

                                <input
                                    type="number"
                                    name="quantity"
                                    value="{{ $item->kuantitas }}"
                                    min="1"
                                    class="form-control form-control-sm qty-input">
                            </form>
                        </td>

                        <!-- Span diberi class agar teks subtotal per baris bisa di-update via js -->
                        <td>
                            Rp <span class="row-subtotal">{{ number_format($item->subtotal) }}</span>
                        </td>

                        <td>
                            @if(auth()->check() && strtolower(auth()->user()->role->name) == 'admin')

                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>

                            @endif
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Keranjang Kosong
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="card-footer">

                <!-- Menggunakan span target agar total bayar langsung ter-update otomatis -->
                <strong>
                    Rp <span id="grand-total">{{ number_format($sale->total_pembayaran) }}</span>
                </strong>

                <form method="POST"
                    action="{{ route('penjualan.update', $sale->id) }}"
                    onsubmit="return confirm('Yakin ingin checkout')" class="mt-2">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" class="form-select mb-2" required>
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <!-- Atribut 'disabled' bawaan dihapus agar tombol checkout selalu aktif merespon klik -->
                    <button type="submit" class="btn btn-success w-100">
                        Checkout
                    </button>
                </form>

                @if(auth()->check() && strtolower(auth()->user()->role->name) == 'admin')

                <form action="{{ route('penjualan.destroy', $sale->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Batalkan Transaksi
                    </button>

                </form>

                @endif
            </div>
        </div>
    </div>

</div>

<!-- AJAX SCRIPT UNTUK MENGHITUNG DAN MENYIMPAN DINAMIS -->
<script>
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('input', function() {
            let row = this.closest('.cart-row');
            let form = this.closest('.qty-form');

            let qty = parseInt(this.val) || parseInt(this.value) || 0;
            let harga = parseFloat(row.getAttribute('data-harga')) || 0;

            // 1. Hitung visual subtotal secara instan di layar browser
            let subtotal = qty * harga;
            row.querySelector('.row-subtotal').innerText = subtotal.toLocaleString('id-ID');

            // 2. Hitung total bayar keseluruhan (Grand Total) secara instan
            let totalSemua = 0;
            document.querySelectorAll('.cart-row').forEach(r => {
                let rQty = parseInt(r.querySelector('.qty-input').value) || 0;
                let rHarga = parseFloat(r.getAttribute('data-harga')) || 0;
                totalSemua += (rQty * rHarga);
            });
            document.getElementById('grand-total').innerText = totalSemua.toLocaleString('id-ID');

            // 3. Kirim data kuantitas baru ke server database Laravel di latar belakang (AJAX)
            let formData = new FormData(form);
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Kuantitas berhasil sinkron ke database.');
                })
                .catch(error => {
                    console.error('Koneksi database/controller terhambat:', error);
                });
        });
    });
</script>

@endsection