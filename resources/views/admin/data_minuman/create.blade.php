@extends('layout.app')

@section('header', 'Tambah Minuman')

@section('content')
    <div class="form">
        <form action="/admin/data-minuman" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_minuman" class="form-label">Nama Minuman:</label>
                <input type="text" class="form-control @error('nama_minuman') is-invalid @enderror" id="nama_minuman" placeholder="Nama Minuman" name="nama_minuman" value="{{ old('nama_minuman') }}" required>
                @error('nama_minuman')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Gambar Minuman:</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img" value="{{ old('img') }}" required onchange="previewImage()">
                @error('img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            <img src="" class="img-preview" style="margin-top: 15px">
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga Minuman:</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-danger" href="/admin/data-minuman">Kembali</a>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>


    <script>
        function previewImage() {
            const image = document.querySelector("#img");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = 'block';
            imgPreview.style.width = '150px';
            imgPreview.style.height = '150px';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
