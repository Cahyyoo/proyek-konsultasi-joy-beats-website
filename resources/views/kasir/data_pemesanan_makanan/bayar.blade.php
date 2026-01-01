@extends('layout.app')

@section('header', 'Pembayaran')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js">
    </script>


    <div class="form">

        <div class="card p-4 shadow-sm">
            <h4 class="fw-bold mb-3">Total Pembayaran</h4>

            <div class="alert alert-info">
                 {{-- <img src="{{ $qr_url }}" width="300">

                <p class="mt-4">Total Pembayaran: <b>Rp {{ number_format($trx->jumlah) }}</b></p> --}}

                <strong>Rp {{ number_format($totalBayar) }}</strong>
            </div>

            <button id="pay-button" class="btn btn-primary w-100 py-2">
                Bayar Sekarang
            </button>
        </div>

    </div>

        <script>
            document.getElementById('pay-button').onclick = function(){
                snap.pay("{{ $snapToken }}", {
                    onSuccess: function(result){
                        window.location.href = "/admin/data-pemesanan-makanan-minuman?status=success";
                        console.log(result);
                    },
                    onPending: function(result){ console.log(result); },
                    onError: function(result){ console.log(result); },
                });
            };
        </script>

        {{-- <script>
        // Auto cek status tiap 3 detik
        setInterval(function(){
            fetch("/api/check-status/{{ $trx->id }}")
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'paid'){
                        alert("Pembayaran Berhasil!");
                        window.location.href = "/";  // redirect home
                    }
                })
        }, 3000);
    </script> --}}
@endsection
