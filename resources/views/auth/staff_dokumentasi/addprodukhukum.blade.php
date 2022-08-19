@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengisian Metadata</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/staffd/addprodukhukum" method="post" enctype="multipart/form-data">
            @csrf
            <div class="fs-6">
                No & Tahun
            </div>
            <input type="text" class="form-control input @error('no_tahun') is-invalid @enderror mt-2" 
            name="no_tahun" id="no_tahun" value="{{ old('no_tahun') }}">

            @error('no_tahun')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Tentang
            </div>
            <input type="text" class="form-control input mt-2" name="tentang" id="tentang" 
            value="{{  old('tentang') }}">

            @error('tentang')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Subjek
            </div>
            <input type="text" class="form-control input mt-2" name="subjek" id ="subjek" 
            value="{{ old('subjek') }}">

            @error('subjek')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror
            
            <div class="row">
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="fs-6 mt-3">
                        Tanggal Pengundangan
                    </div>
                    <input type="date" class="form-control input mt-2" name="tanggal_pengundangan" id="tanggal_pengundangan" value="{{old('tanggal_pengundangan')}}">

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
                        Upload TTD Walikota
                    </div>
                    <input type="file" class="form-control input @error('ttd_walikota') is-invalid @enderror mt-2" 
                    name="ttd_walikota" id="ttd_walikota">

                    @error('ttd_walikota')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>

                @if(isset($draft->ttd_walikota))
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <a href="{{ asset('storage/' . $draft->ttd_walikota)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        Upload TTD Walikota Salinan
                    </div>
                    <input type="file" class="form-control input @error('ttd_walikota_salinan') is-invalid @enderror mt-2" 
                    name="ttd_walikota_salinan" id="ttd_walikota_salinan">

                    @error('ttd_walikota_salinan')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
                </div>

                @if(isset($draft->produkHukum->ttd_walikota_salinan))
                <div class="col-6">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <a href="{{ asset('storage/' . $draft->ttd_walikota_salinan)}}" class="btn btn-primary mt-2">Download</a>
                </div>
                @endif
            </div>
        
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