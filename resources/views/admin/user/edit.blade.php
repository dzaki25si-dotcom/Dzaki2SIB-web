@extends('layouts.admin.app')

@section('content')
<div class="py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">Edit User</h1>
            <p class="text-muted mb-0">Perbarui data pengguna.</p>
        </div>

        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Pesan validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum valid!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        placeholder="contoh@email.com"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Kosongkan jika tidak ingin mengganti password"
                    >

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Isi minimal 8 karakter jika ingin mengganti password.
                    </small>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Masukkan ulang password baru"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Update User
                </button>

                <a href="{{ route('user.index') }}" class="btn btn-light">
                    Batal
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
