@extends('auth.main')

@section('content')
@if(session()->has('success'))  
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  {{ session()->get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
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
            <div class="col-6">
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
                <a href="{{ asset('storage/' . $draft->ttd_walikota)}}" class="btn btn-primary mt-2">Download</a> 
            </div>
        </div>

        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection