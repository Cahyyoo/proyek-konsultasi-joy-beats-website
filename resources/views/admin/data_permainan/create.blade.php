@extends('layout.app')

@section('header', 'Tambah Permainan')

@section('content')
    <div class="form">
        <form action="/admin/data-permainan" method="post">
            @csrf
            <div class="mb-3">
                <label for="no_permainan" class="form-label">No Permainan</label>
                <select class="form-control @error('no_permainan') is-invalid @enderror" id="no_permainan" name="no_permainan" required>
                    <option value="">Pilihan</option>
                    @for ($i = 1; $i < 101; $i++)
                        <option>{{ $i }}</option>
                    @endfor
                </select>
                @error('no_permainan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_permainan" class="form-label">Jenis Permaian</label>
                <select class="form-control @error('jenis_permainan') is-invalid @enderror" id="jenis_permainan" name="jenis_permainan" required>
                    <option value="">Pilihan</option>
                    <option value="bl">Billiard</option>
                    <option value="ps">Playstation</option>
                    <option value="rs">Race Simulation</option>
                </select>
                @error('jenis_permainan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-danger" href="/admin/data-permainan">Kembali</a>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
