@extends('layout.app')

@section('header', 'Edit Mahasiswa')

@section('content')
    <div class="form">
        <form action="/admin/data-mahasiswa/{{ $dataMahasiswa->id }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="nama" class="form-label">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ $dataMahasiswa->user->email }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama" value="{{ $dataMahasiswa->nama }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Nim:</label>
                <input type="number" class="form-control  @error('nim') is-invalid @enderror" id="nim" placeholder="Nim" name="nim" value="{{ $dataMahasiswa->nim }}" required>
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                <i style="font-size: 13px">*Jika tidak ingin mengganti passowrd, tidak perlu diisi!</i>
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
