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
        <form action="/dashboard/staffd/process/{{$draft->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="fs-6">
                No & Tahun
            </div>

            @if(isset($draft->produkHukum->no_tahun))
            <input type="text" class="form-control input @error('no_tahun') is-invalid @enderror mt-2" 
            name="no_tahun" id="no_tahun" value="{{ old('no_tahun', $draft->produkHukum->no_tahun) }}">
            @else
            <input type="text" class="form-control input @error('no_tahun') is-invalid @enderror mt-2" 
            name="no_tahun" id="no_tahun" value="{{ old('no_tahun') }}">
            @endif

            @error('no_tahun')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Tentang
            </div>

            @if(isset($draft->produkHukum->tentang))
            <input type="text" class="form-control input mt-2" name="tentang" id="tentang" 
            value="{{  old('tentang', $draft->produkHukum->tentang) }}">
            @else
            <input type="text" class="form-control input mt-2" name="tentang" id="tentang" 
            value="{{  old('tentang', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->judul) }}">
            @endif

            @error('tentang')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Subjek
            </div>

            @if(isset($draft->produkHukum->subjek))
            <input type="text" class="form-control input mt-2" name="subjek" id ="subjek" 
            value="{{ old('subjek', $draft->produkHukum->subjek) }}">
            @else
            <input type="text" class="form-control input mt-2" name="subjek" id ="subjek" 
            value="{{ old('subjek', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->jenis) }}">
            @endif

            @error('subjek')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror
            
            <div class="fs-6 mt-3">
                Status
            </div>

            @if(isset($draft->produkHukum->status))
            <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->status }}" readonly>
            @else
            <input type="text" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->status }}" readonly>
            @endif

            <div class="row">
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <div class="fs-6 mt-3">
                        Tanggal Pengundangan
                    </div>

                    @if(isset($draft->produkHukum->tanggal_pengundangan))
                    <input type="date" class="form-control input mt-2" name="tanggal_pengundangan" id="tanggal_pengundangan" value="{{old('tanggal_pengundangan', $draft->produkHukum->tanggal_pengundangan)}}">
                    @else
                    <input type="date" class="form-control input mt-2" name="tanggal_pengundangan" id="tanggal_pengundangan" value="{{old('tanggal_pengundangan')}}">
                    @endif

                    @error('tanggal_pengundangan')
                        <div class="text-danger">
                            <small>{{ $message }}</small> 
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                <div class="col">
                    <div class="fs-6 mt-3">
                        File Lama
                    </div>
                    <div class="row mt-2">
                        <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                            <div class="row">
                                <div class="col-1">
                                    <i class="fa-solid fa-file"></i>
                                </div>
                                <div class="col-10">
                                    <input type="text" value="{{ $draft->ttd_walikota }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <a href="{{ asset('storage/' . $draft->ttd_walikota )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                        </div>
                    </div>
                    <!-- <a href="{{ asset('storage/' . $draft->ttd_walikota)}}" class="btn btn-primary mt-2">Download</a> -->
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6">
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

            @if($draft->keterangan_penolakan)
            <div class="fs-6 mt-3">
                Keterangan Penolakan
            </div>
            <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->keterangan_penolakan}}</Textarea>
            @endif

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