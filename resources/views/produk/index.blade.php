@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<h1 class="text-dark fw-bold my-4">Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">Tambah Produk</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input
      type="text"
      name="search"
      value=""
      class="form-control"
      placeholder="Search nama produk">
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
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">User</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Foto</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Nama</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Harga Beli</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Harga Jual</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Stok</th>
      <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row" class="ps-3">{{ $products->firstItem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>
        <img src="{{ asset('storage/' .$product->foto) }}"
          width="100"
          class="img-thumbnail">
      </td>
      <td class="fw-semibold text-secondary">{{ $product->nama }}</td>
      <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
      <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
      <td>
        <span class="badge {{ $product->stok <= 5 ? 'bg-danger-subtle text-danger' : 'bg-light text-dark' }} border px-2 py-1.5">
          {{ $product->stok }}
        </span>
      </td>
      <td>
        <div class="d-flex gap-1">
          @can('view', $product)
          <a href="{{ route('produk.show', $product) }}" class="btn btn-primary btn-sm fw-medium">
            Detail
          </a>
          @endcan
          @can('update', $product)
          <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm fw-medium">Edit</a>
          @endcan
          @can('delete', $product)
          <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm fw-medium" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
              Hapus
            </button>
          </form>
          @endcan
        </div>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="8" class="text-center py-5 text-muted">
        <h4>Data tidak tersedia</h4>
      </td>
    </tr>
    @endforelse
  </tbody>
</table>

<div class="mt-3">
  {{ $products->links() }}
</div>

@endsection