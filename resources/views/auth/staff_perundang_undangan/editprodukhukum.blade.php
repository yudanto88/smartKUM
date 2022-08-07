@extends('auth.main')

@section('content')
@if(session()->has('success'))  
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  {{ session()->get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/staffu/editprodukhukum/{{$draft->id}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="fs-6">
                Operator SKPD
            </div>
            <input type="text" class="form-control input mt-2" value="{{ $draft->admin->draft->user->name }}" readonly>

            <div class="fs-6 mt-3">
                Jenis / Bentuk Peraturan 
            </div>
            <input type="text" class="form-control input mt-2" value="{{ $draft->admin->draft->jenis }}" readonly>

            <div class="fs-6 mt-3">
                Judul Produk Hukum 
            </div>
            <input type="text" class="form-control input mt-2" value="{{ $draft->admin->draft->judul }}" readonly>

            <div class="row">
                <div class="col-2">
                    <div class="fs-6 mt-3">
                        Tanggal Pengajuan
                    </div>
                    <input type="date" class="form-control input mt-2" value="{{ $draft->admin->draft->tanggal_pengajuan }}" readonly>
                </div>
            </div>

            <div class="fs-6 mt-3">
                Keterangan Admin FO
            </div>
            <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->admin->keterangan }}</Textarea>

            <div class="row">
                <div class="col-2">
                    <div class="fs-6 mt-3">
                        Surat Pengajuan
                    </div>
                    <a href="{{ asset('storage/' . $draft->admin->draft->surat_pengajuan)}}" class="btn btn-primary mt-2">Download</a>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <div class="fs-6 mt-3">
                        Draft Produk Hukum
                    </div>
                    <a href="{{ asset('storage/' . $draft->admin->draft->draft_produk_hukum)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @if($draft->admin->draft->draft_produk_hukum_lama)
                <div class="col-4">
                    <div class="fs-6 mt-3">
                        Draft Produk Hukum Lama
                    </div>
                    <a href="{{ asset('storage/' . $draft->admin->draft->draft_produk_hukum_lama)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="fs-6 mt-3">
                        Upload Revisi Produk Hukum
                    </div>
                    <input type="file" class="form-control input @error('revisi_produk_hukum') is-invalid @enderror mt-2" 
                    name="revisi_produk_hukum" id="revisi_produk_hukum">

                    @error('revisi_produk_hukum')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>

                @if(isset($draft->revisi_produk_hukum))
                <div class="col-3">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <a href="{{ asset('storage/' . $draft->revisi_produk_hukum)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="fs-6 mt-3">
                        Upload NPKND
                    </div>
                    <input type="file" class="form-control input @error('npknd') is-invalid @enderror mt-2" 
                    name="npknd" id="npknd">

                    @error('npknd')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>

                @if(isset($draft->npknd))
                <div class="col-3">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <a href="{{ asset('storage/' . $draft->npknd)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @endif
            </div>

            <div class="fs-6 mt-3">
                Keterangan
            </div>
            <textarea type="text" class="form-control input mt-2" 
            name="keterangan" id="keterangan" style="height:100px">{{ old('keterangan') }}</Textarea>

            @if($draft->keterangan_penolakan)
            <div class="fs-6 mt-3">
                Keterangan Penolakan
            </div>
            <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->keterangan_penolakan}}</Textarea>
            @endif
            
            <div class="row justify-content-end mt-4 mb-4">
                <div class="col-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-2">Proses</button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection