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
        <div class="fs-6">
            Operator SKPD
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->kabag->kasubagUndang->staffUndang->admin->draft->user->name }}" readonly>

        <div class="fs-6 mt-3">
            Jenis / Bentuk Peraturan 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->kabag->kasubagUndang->staffUndang->admin->draft->jenis }}" readonly>

        <div class="fs-6 mt-3">
            Judul Produk Hukum 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->kabag->kasubagUndang->staffUndang->admin->draft->judul }}" readonly>

        <div class="row">
            <div class="col-2">
                <div class="fs-6 mt-3">
                    Tanggal Pengajuan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->kabag->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan }}" readonly>
            </div>
        </div>

        <div class="fs-6 mt-3">
            Keterangan Kabag
        </div>
        <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->kabag->keterangan }}</Textarea>

        <div class="row">
            <div class="col-2">
                <div class="fs-6 mt-3">
                    Surat Pengajuan
                </div>
                <a href="{{ asset('storage/' . $draft->kabag->kasubagUndang->staffUndang->admin->draft->surat_pengajuan)}}" class="btn btn-primary mt-2">Download</a>
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum
                </div>
                <a href="{{ asset('storage/' . $draft->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum)}}" class="btn btn-primary mt-2">Download</a>
            </div>
            @if($draft->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama)
            <div class="col-4">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum Lama
                </div>
                <a href="{{ asset('storage/' . $draft->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama)}}" class="btn btn-primary mt-2">Download</a>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-2">
                <div class="fs-6 mt-3">
                    Revisi Produk Hukum
                </div>
                <a href="{{ asset('storage/' . $draft->kabag->kasubagUndang->staffUndang->revisi_produk_hukum)}}" class="btn btn-primary mt-2">Download</a>
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="fs-6 mt-3">
                    NPKND
                </div>
                <a href="{{ asset('storage/' . $draft->kabag->kasubagUndang->staffUndang->npknd)}}" class="btn btn-primary mt-2">Download</a>
            </div>
        </div>
            
        @if($draft->status == 'menunggu')
        <form action="/dashboard/kepaladinas/process/{{$draft->id}}" method="post">
            @csrf
            <div class="fs-6 mt-3">
                Keterangan
             </div>
            <textarea type="text" class="form-control input mt-2" 
            name="keterangan" id="keterangan" style="height:100px">{{ old('keterangan') }}</Textarea>

            <div class="row justify-content-between mt-4 mb-4">
                <div class="col-3 ">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger mt-2" name="action" value="tolak">Tolak</button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-2" name="action" value="proses">Proses</button>
                    </div>
                </div>
            </div>
        </form>
        @endif
        
        @if($draft->status == 'ditolak' || $draft->status == 'diterima')
        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
        @endif
    </div>
</div>
@endsection