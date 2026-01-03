@extends('layout.app')

@section('header', 'Data Permainan')

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
        <a href="/admin/data-permainan/create" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="mt-3 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Permainan</th>
                    <th>Jenis Permainan</th>
                    <th colspan="2" class="text-center">Opsi</th>
                </tr>
            </thead>
            @foreach($data as $data)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->no_permainan }}</td>
                        @if($data->jenis_permainan == "bl")
                            <td>Billiard</td>
                            @elseif ($data->jenis_permainan == "ps")
                            <td>PlayStation</td>
                            @elseif ($data->jenis_permainan == "rs")
                            <td>Race Simulation</td>
                        @endif
                        <td class="text-center" width=10>
                            <div class="">
                                <a href="/admin/data-permainan/{{ $data->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </div>
                        </td>
                        <td class="text-center" width=10>
                            <form action="/admin/data-permainan/{{ $data->id }}" method="post">
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
