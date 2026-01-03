@extends('layout.app')

@section('header', 'Data Barcode')

@section('content')

    @if( Session::has('success') )
    <div class="alert alert-success mt-2 py-3">
        <i class=" fa fa-info-circle mr-1"></i>
        {{-- <button type="button" class="close" data-dismiss="alert" >&times;</button> --}}
        {{ Session::get('success') }}
    </div>
    @endif

    @if( Session::has('danger') )
    <div class="alert alert-danger mt-2 py-3">
        <i class=" fa fa-info-circle mr-1"></i>
        {{-- <button type="button" class="close" data-dismiss="alert" >&times;</button> --}}
        {{ Session::get('danger') }}
    </div>
    @endif

    <div class="d-flex justify-content-end gap-2">
        <a href="/admin/data-barcode/create" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="mt-3 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar Barcode</th>
                    <th>Link Barcode</th>
                    <th>Keterangan Barcode</th>
                    <th colspan="2" class="text-center">Opsi</th>
                </tr>
            </thead>
            @foreach($data as $data)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $data->img) }}" alt="gambar-{{ $data->ket_barcode }}" style="width: 150px; height: 150px">
                        </td>
                        <td><a href="{{ url("/pesan-makanan/$data->uuid") }}">{{ url("/pesan-makanan/$data->uuid") }}</a></td>
                        <td>{{ $data->ket_barcode }}</td>
                        <td class="text-center" width=10>
                            <form action="/admin/data-barcode/{{ $data->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return(confirm('Apakah anda yakin untuk menghapus data ini?'))" style="border: none; background-color:transparent; color:blue">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
