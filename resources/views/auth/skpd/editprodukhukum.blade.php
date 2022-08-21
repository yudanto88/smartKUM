@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/skpd/editprodukhukum/{{$draft->id}}" method="post" enctype="multipart/form-data">
            @method('put')
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

            @error('jenis')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror

            <div class="fs-6 mt-3">
                Judul Produk Hukum 
            </div>
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id="judul" value="{{ old('judul', $draft->judul)}}">

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
                    name="tanggal" id="tanggal" value="{{ old('tanggal', $draft->tanggal_pengajuan)}}">
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
            name="keterangan" id="keterangan" style="height:100px">{{ old('keterangan', $draft->keterangan)}}</Textarea>

            <div class="row">
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        Revisi Surat Pengajuan
                    </div>
                    <input type="file" class="form-control input @error('file_pengajuan') is-invalid @enderror mt-2" 
                    name="file_pengajuan" id="file_pengajuan">

                    @error('file_pengajuan')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <div class="mt-3">
                        <span class="rounded-3 border-1 border border-dark px-2 py-2" style="background-color: #e9ecef">
                            <i class="fa-solid fa-file me-2"></i>
                            <input type="text" value="{{$draft->surat_pengajuan}}" style="border: none; background-color: #e9ecef; width:50%;" readonly>
                        </span>
                        <a href="{{ asset('storage/' . $draft->surat_pengajuan)}}" class="ms-2" style="vertical-align: baseline">Download</a>
                    </div>
                    <!-- <a href="{{ asset('storage/' . $draft->surat_pengajuan)}}" class="btn btn-primary mt-2">Download</a> -->
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        Revisi Draft Produk Hukum
                    </div>
                    <input type="file" class="form-control input @error('draft_produk_hukum') is-invalid @enderror mt-2" 
                    name="draft_produk_hukum" id="draft_produk_hukum">

                    @error('draft_produk_hukum')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <div class="mt-3">
                        <span class="rounded-3 border-1 border border-dark px-2 py-2" style="background-color: #e9ecef">
                            <i class="fa-solid fa-file me-2"></i>
                            <input type="text" value="{{ $draft->draft_produk_hukum }}" style="border: none; background-color: #e9ecef; width:50%;" readonly>
                        </span>
                        <a href="{{ asset('storage/' . $draft->draft_produk_hukum )}}" class="ms-2" style="vertical-align: baseline">Download</a>
                    </div>
                    <!-- <a href="{{ asset('storage/' . $draft->draft_produk_hukum)}}" class="btn btn-primary mt-2">Download</a> -->
                </div>
            </div>

            <div class="fs-6 mt-3">
                Keterangan Penolakan
            </div>
            <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->keterangan_penolakan}}</Textarea>
            
            <div class="d-grid gap-2 mt-4 mb-4">
                <button class="btn btn-primary" type="submit">Kirim</button>
            </div>
            
        </form>
    </div>
</div>
@endsection