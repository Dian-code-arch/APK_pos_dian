@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<h1 class="text-dark fw-bold my-4"> Halaman Users </h1>

<a href="{{ route('admin.users.create') }}" method="GET" class="btn btn-primary mb-3">Tambah User</a>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari berdasarkan nama atau email">
        <button class="btn btn-secondary">search</button>
    </div>
</form>

<table class="table table-hover align-middle">
    <!-- CSS Tambahan Khusus untuk Memaksa Gradasi Tembus di Bootstrap -->
    <thead style="border-bottom: 2px solid #dee2e6;">
        <tr style="background: linear-gradient(90deg, #cfe2ff 0%, #d1e7dd 100%) !important;">
            <th scope="col" class="py-3 ps-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">#</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Name</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Email</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Role</th>
            <th scope="col" class="py-3" style="background: transparent !important; color: #1e293b !important; font-weight: 600;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="ps-3">{{ $users->firstItem() + $loop->index }}</td>
            <td class="fw-semibold text-secondary">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge bg-light text-dark border px-2 py-1.5">
                    {{ $user->role->name }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm me-1 fw-medium">
                    Edit Akun
                </a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm fw-medium" onclick="return confirm('Yakin hapus user ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection