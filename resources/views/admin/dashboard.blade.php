@extends('layout.app')

@section('header', 'Dashboard')

@section('content')

<div class="row">

    {{-- TOTAL TRANSAKSI --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h6 class="text-muted">Total Transaksi</h6>
                <h3 class="fw-bold">{{ $totalTransaksi }}</h3>
            </div>
        </div>
    </div>

    {{-- TOTAL PENDAPATAN --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h6 class="text-muted">Total Pendapatan</h6>
                <h3 class="fw-bold text-success">
                    Rp {{ number_format($totalPendapatan) }}
                </h3>
            </div>
        </div>
    </div>

    {{-- TOTAL MAKANAN --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Makanan</h6>
                <h3 class="fw-bold">{{ $totalMakanan }}</h3>
            </div>
        </div>
    </div>

    {{-- TOTAL MINUMAN --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Minuman</h6>
                <h3 class="fw-bold">{{ $totalMinuman }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- TRANSAKSI TERBARU --}}
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header fw-bold bg-white">
        🧾 Transaksi Terbaru
    </div>
    <div class="card-body table-responsive">

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Item</th>
                    <th>Jenis</th>
                    <th>Qty</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestOrders as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode_transaksi }}</td>
                    <td>{{ $row->detail }}</td>
                    <td>
                        @if($row->makanan_id)
                            <span class="badge bg-success">Makanan</span>
                        @else
                            <span class="badge bg-info">Minuman</span>
                        @endif
                    </td>
                    <td>{{ $row->qty }}</td>
                    <td>Rp {{ number_format($row->jumlah_harga) }}</td>
                    <td>
                        <span class="badge bg-secondary">
                            {{ $row->ket }}
                        </span>
                    </td>
                    <td>
                        {{ $row->created_at->format('d-m-Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
