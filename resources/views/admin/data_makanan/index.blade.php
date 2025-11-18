@extends('layout.app')

@section('header', 'Data Makanan')

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
        <a href="/admin/data-makanan/create" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="mt-3 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Gambar Makanan</th>
                    <th>Harga</th>
                    <th colspan="2" class="text-center">Opsi</th>
                </tr>
            </thead>
            @foreach($data as $data)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_makanan }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $data->img) }}" alt="gambar-{{ $data->nama_makanan }}" style="width: 150px; height: 150px">
                        </td>
                        <td>{{ $data->harga }}</td>
                        <td class="text-center" width=10>
                            <div class="">
                                <a href="/admin/data-makanan/{{ $data->id }}/edit"><i class="fa-solid fa-pen-to-square"></i>edit</a></td>
                            </div>
                        </td>
                        <td class="text-center" width=10>
                            <form action="/admin/data-makanan/{{ $data->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return(confirm('Apakah anda yakin untuk menghapus data ini?'))" style="border: none; background-color:transparent; color:blue">
                                    <i class="fa-solid fa-trash"></i>
                                    hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
