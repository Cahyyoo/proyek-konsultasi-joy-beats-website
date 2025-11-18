@extends('layout.app')

@section('header', 'Dashboard')

@section('content')

    {{-- <div class="d-flex gap-2 " style="flex-wrap: wrap"> --}}
        {{-- <div class="col-3">
            <div class="card" style="width: 16rem;">
                <img src="https://placebear.com/800/600" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Data Mahasiswa</h5>
                <p class="card-text">Data mahasiswa dari program studi teknik komputer angkatan 2023</p>
                <a href="/admin/data-mahasiswa" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 16rem;">
                <img src="https://placebear.com/800/600" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Data Quesioner</h5>
                <p class="card-text">Data mahasiswa dari program studi teknik komputer angkatan 2023</p>
                <a href="/admin/quesioner" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 16rem;">
                <img src="https://placebear.com/800/600" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Data Peminatan</h5>
                <p class="card-text">Data mahasiswa dari program studi teknik komputer angkatan 2023</p>
                <a href="/admin/peminatan" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div> --}}

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>

        <input type="hidden" class="d-none" value="{{ $dataNetw }}" id="dataNetw">
        <input type="hidden" class="d-none" value="{{ $dataIntell }}" id="dataIntell">
        <input type="hidden" class="d-none" value="{{ $dataEmbedd }}" id="dataEmbedd">
    {{-- </div> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/assets/demo/chart-bar-demo.js') }}"></script>
@endsection
