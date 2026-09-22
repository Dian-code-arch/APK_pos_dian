@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mt-5">
  <h4>Tambah Produk</h4>

  <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @include('Produk._form')
  </form>
</div>
@endsection