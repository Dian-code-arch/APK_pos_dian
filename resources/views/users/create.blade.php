@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<!-- Membungkus dengan div class mt-5 untuk memberi jarak dari navbar -->
<div class="container mt-5">
    <h4>Tambah Users</h4>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @include('users._form')
    </form>
</div>
@endsection