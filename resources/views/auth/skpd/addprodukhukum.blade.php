@extends('auth.main')

@section('content')
@if(session()->has('success'))  
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  {{ session()->get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengajuan Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/skpd/addprodukhukum" method="post" enctype="multipart/form-data">
        @csrf
            <div class="fs-6">
                Jenis / Bentuk Peraturan 
            </div>
            <input type="text" class="form-control input @error('jenis') is-invalid @enderror mt-2" 
            name="jenis" id="jenis" value="{{ old('jenis') }}">

            @error('jenis')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror

            <div class="fs-6 mt-3">
                Judul Produk Hukum 
            </div>
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id="judul" value="{{ old('judul') }}">

            @error('judul')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror

            <div class="row">
                <div class="col">
                    <div class="fs-6 mt-3">
                        Tanggal Pengajuan
                    </div>
                    <input type="date" class="form-control input @error('tanggal') is-invalid @enderror mt-2" 
                    name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                </div>

                @error('tanggal')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
                @enderror
            </div>

            <div class="fs-6 mt-3">
                Keterangan
            </div>
            <textarea type="text" class="form-control input mt-2" 
            name="keterangan" id="keterangan" style="height:100px">{{ old('keterangan') }}</Textarea>

            <div class="row">
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        Upload Surat Pengajuan
                    </div>
                    <input type="file" class="form-control input @error('file_pengajuan') is-invalid @enderror mt-2" 
                    name="file_pengajuan" id="file_pengajuan">

                    @error('file_pengajuan')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        Upload Draft Produk Hukum
                    </div>
                    <input type="file" class="form-control input @error('draft_produk_hukum') is-invalid @enderror mt-2" 
                    name="draft_produk_hukum" id="draft_produk_hukum">

                    @error('draft_produk_hukum')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-4 mb-4">
                <button class="btn btn-primary" type="submit">Kirim</button>
            </div>
            
        </form>
    </div>
</div>
@endsection