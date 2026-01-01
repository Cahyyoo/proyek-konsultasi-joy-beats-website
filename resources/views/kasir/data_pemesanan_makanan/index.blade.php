@extends('layout.app')

@section('header', 'Data Pemesanan')

@section('content')

@if(Session::has('success'))
<div class="alert alert-success mt-2 py-3">
    <i class="fa fa-info-circle mr-1"></i>
    {{ Session::get('success') }}
</div>
@endif

@if(Session::has('danger'))
<div class="alert alert-danger mt-2 py-3">
    <i class="fa fa-info-circle mr-1"></i>
    {{ Session::get('danger') }}
</div>
@endif

<div class="d-flex justify-content-end gap-2 mb-3">
    <a href="/kasir/data-pemesanan-makanan-minuman/create" class="btn btn-primary">
        Tambah Pesanan
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Barcode</th>
                <th class="text-center">Kode Transaksi</th>
                <th class="text-center">Item</th>
                <th class="text-center">Jenis</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Jumlah Harga</th>
                <th class="text-center">Detail</th>
                <th class="text-center">Status</th>
                <th class="text-center">Tanggal</th>
            </tr>
        </thead>

        <tbody>
        @foreach($data as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->barcode_id }}</td>
                <td class="text-center">{{ $item->kode_transaksi }}</td>

                {{-- ITEM --}}
                <td class="text-center">
                    @if($item->makanan_id)
                        {{ $item->makanan->nama_makanan }}
                    @elseif($item->minuman_id)
                        {{ $item->minuman->nama_minuman }}
                    @else
                        -
                    @endif
                </td>

                {{-- JENIS --}}
                <td class="text-center">
                    @if($item->makanan_id)
                        <span class="badge bg-success">Makanan</span>
                    @elseif($item->minuman_id)
                        <span class="badge bg-info">Minuman</span>
                    @endif
                </td>

                <td class="text-center">{{ $item->qty }}</td>

                <td class="text-end">
                    Rp {{ number_format($item->jumlah_harga, 0, ',', '.') }}
                </td>

                <td class="text-center">{{ $item->detail }}</td>

                <td class="text-center">
                    <span class="badge bg-secondary">
                        {{ $item->ket }}
                    </span>
                </td>

                <td class="text-center">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
