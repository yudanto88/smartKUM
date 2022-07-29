@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengajuan Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <form action="">
        @csrf
            <div class="fs-6">
                Jenis / Bentuk Peraturan 
            </div>
            <input type="text" class="form-control input @error('jenis') is-invalid @enderror mt-2" 
            name="jenis" id="jenis">

            <div class="fs-6 mt-3">
                Judul Produk Hukum 
            </div>
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id="judul">

            <div class="row">
                <div class="col-5">
                    <div class="fs-6 mt-3">
                        Tanggal Pengajuan
                    </div>
                    <input type="date" class="form-control input @error('tanggal') is-invalid @enderror mt-2" 
                    name="tanggal" id="tanggal">
                </div>
            </div>

            <div class="fs-6 mt-3">
                Keterangan
            </div>
            <input type="text" class="form-control input @error('keterangan') is-invalid @enderror mt-2" 
            name="keterangan" id="keterangan" style="height:100px">

            <div class="row">
                <div class="col-5">
                    <div class="fs-6 mt-3">
                        Upload Surat Pengajuan
                    </div>
                    <input type="file" class="form-control input @error('file_pengajuan') is-invalid @enderror mt-2" 
                    name="file_pengajuan" id="file_pengajuan">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-5">
                    <div class="fs-6 mt-3">
                        Upload Draft Produk Hukum
                    </div>
                    <input type="file" class="form-control input @error('draft_produk_hukum') is-invalid @enderror mt-2" 
                    name="draft_produk_hukum" id="draft_produk_hukum">
                </div>
            </div>
            
            
        </form>
    </div>
</div>
@endsection