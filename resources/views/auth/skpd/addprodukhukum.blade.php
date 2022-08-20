@extends('auth.main')

@section('content')
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
            <select class="form-select mt-2" aria-label="Default select example" 
            name="jenis" id="jenis">
            @foreach($jenis as $x)
            <option value="{{$x->id}}" {{ old('jenis') == $x->id ? 'selected' : null }} >{{$x->jenis}}</option>
            @endforeach
            </select>

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
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
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