@extends('layout.app')

@section('header', 'Tambah Barcode')

@section('content')
    <div class="form">
        <form action="/admin/data-barcode" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="img" class="form-label">Gambar:</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img" value="{{ old('img') }}" required onchange="previewImage()">
                @error('img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            <img src="" class="img-preview" style="margin-top: 15px">
            </div>

            <div class="mb-3">
                <label for="ket_barcode" class="form-label">Keterangan Barcode:</label>
                <input type="text" class="form-control @error('ket_barcode') is-invalid @enderror" id="ket_barcode" placeholder="Keterangan Barcode" name="ket_barcode" value="{{ old('ket_barcode') }}" required>
                @error('ket_barcode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-danger" href="/admin/data-barcode">Kembali</a>
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
