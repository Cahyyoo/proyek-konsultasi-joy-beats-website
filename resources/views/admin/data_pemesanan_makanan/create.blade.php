@extends('layout.app')

@section('header', 'Tambah Makanan dan Minuman')

@section('content')
    <div class="form">
        <form action="/admin/data-pemesanan-makanan-minuman" method="post">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Nim:</label>
                <input type="number" class="form-control  @error('nim') is-invalid @enderror" id="nim" placeholder="Nim" name="nim" value="{{ old('nim') }}" required>
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a class="btn btn-danger" href="/admin/data-mahasiswa">Kembali</a>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
