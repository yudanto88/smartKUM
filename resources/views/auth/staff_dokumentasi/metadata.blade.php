@extends('auth.main')

@section('content')
@if(session()->has('success'))  
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  {{ session()->get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengisian Metadata</h1>
</div>
<div class="row">
    <div class="col">
        <div class="fs-6">
            No & Tahun
        </div>
        <input type="text" class="form-control input mt-2" name="no_tahun" id="no_tahun">

        @error('no_tahun')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
        @enderror

        <div class="fs-6 mt-3">
            Tentang
        </div>
        <input type="text" class="form-control input mt-2" name="tentang" id="tentang" 
        value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->judul }}">

        @error('tentang')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
        @enderror

        <div class="fs-6 mt-3">
            Subjek
        </div>
        <input type="text" class="form-control input mt-2" name="subjek" id ="subjek" 
        value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->jenis }}">

        @error('subjek')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
        @enderror
        
        <div class="fs-6 mt-3">
            Status
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->status }}" readonly>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Tanggal Pengundangan
                </div>
                <input type="date" class="form-control input mt-2" name="tanggal_pengundangan" id="tanggal_pengundangan">

                @error('tanggal_pengundangan')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Produk Hukum yang telah di TTD Walikota
                </div>
                <a href="{{ asset('storage/' . $draft->ttd_walikota)}}" class="btn btn-primary mt-2">Download</a>
            </div>
        </div>
            
        <form action="/dashboard/staffd/process/{{$draft->id}}" method="post">
            @csrf
            <div class="fs-6 mt-3">
                Keterangan
             </div>
            <textarea type="text" class="form-control input mt-2" 
            name="keterangan" id="keterangan" style="height:100px">{{ old('keterangan') }}</Textarea>

            <div class="row justify-content-end mt-4 mb-4">
                <div class="col-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-2" >Proses</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection