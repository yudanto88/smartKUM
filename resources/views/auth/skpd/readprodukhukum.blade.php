@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Lihat Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <div class="fs-6">
            Jenis / Bentuk Peraturan 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->jenis}}" readonly>

        <div class="fs-6 mt-3">
            Judul Produk Hukum 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->judul}}" readonly>

        <div class="row">
            <div class="col">
                <div class="fs-6 mt-3">
                    Tanggal Pengajuan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->tanggal_pengajuan}}" readonly>
            </div>
        </div>

        <div class="fs-6 mt-3">
            Keterangan
        </div>
        <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->keterangan}}</Textarea>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Surat Pengajuan
                </div>
                <a href="{{ asset('storage/' . $draft->surat_pengajuan)}}" class="btn btn-primary mt-2">Download</a>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum
                </div>
                <a href="{{ asset('storage/' . $draft->draft_produk_hukum)}}" class="btn btn-primary mt-2">Download</a>
            </div>
            @if($draft->draft_produk_hukum_lama)
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum Lama
                </div>
                <a href="{{ asset('storage/' . $draft->draft_produk_hukum_lama)}}" class="btn btn-primary mt-2">Download</a>
            </div>
            @endif
        </div>
            
        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection