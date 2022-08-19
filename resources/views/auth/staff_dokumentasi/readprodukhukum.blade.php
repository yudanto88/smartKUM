@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Metadata</h1>
</div>
<div class="row">
    <div class="col">
        <div class="fs-6">
            No & Tahun
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->no_tahun }}" readonly>

        <div class="fs-6 mt-3">
            Tentang
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->tentang }}" readonly>

        <div class="fs-6 mt-3">
            Subjek
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->subjek }}" readonly>
            
        <div class="fs-6 mt-3">
            Status
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->status }}" readonly>

         <div class="row">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                <div class="fs-6 mt-3">
                    Tanggal Pengundangan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->produkHukum->tanggal_pengundangan }}" readonly>
                </div> 
            </div>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    TTD Walikota
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->ttd_walikota }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->ttd_walikota )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->ttd_walikota)}}" class="btn btn-primary mt-2">Download</a>  -->
            </div>
        </div>

        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection