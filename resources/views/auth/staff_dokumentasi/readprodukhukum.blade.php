@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Metadata</h1>
</div>
<div class="row">
    <div class="col">
        <div class="fs-6">
            Nomor
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->nomor }}" readonly>

        <div class="fs-6 mt-3">
            Tahun
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->tahun }}" readonly>

        <div class="fs-6 mt-3">
            Judul
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->judul }}" readonly>
        
        <div class="fs-6 mt-3">
            SKPD Pemrakarsa
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->pemrakarsa }}" readonly>

        @if($draft->produkHukum->status_dokumen == 'berlaku' || $draft->produkHukum->status_dokumen == 'dicabut')
        <div class="fs-6 mt-3">
            Status Dokumen
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->status_dokumen }}" readonly>
        @else
        <div class="fs-6 mt-3">
            Status Dokumen
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->status_dokumen }} dokumen {{ $draft->produkHukum->mengganti }}" readonly>
        @endif
            
        <div class="fs-6 mt-3">
            Status
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->status }}" readonly>

        <div class="fs-6 mt-3">
            jenis / Bentuk Peraturan
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->jenis }}" readonly>

        @if(isset($draft->produkHukum->subjek))
        <div class="fs-6 mt-3">
            Subjek
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->subjek }}" readonly>
        @endif

        @if(isset($draft->produkHukum->sumber))
        <div class="fs-6 mt-3">
            Sumber
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->sumber }}" readonly>
        @endif

        <div class="fs-6 mt-3">
            No Regristrasi
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->no_regristrasi }}" readonly>

        @if(isset($draft->produkHukum->bidang_hukum))
        <div class="fs-6 mt-3">
            Bidang Hukum
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->produkHukum->bidang_hukum }}" readonly>
        @endif

         <div class="row">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                <div class="fs-6 mt-3">
                    Tanggal Pengundangan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->produkHukum->tanggal_pengundangan }}" readonly>
            </div> 
        </div>

        @if(isset($draft->walikota->sekda->persetujuan))
        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Persetujuan Sekda
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->sekda->persetujuan }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->persetujuan )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($draft->walikota->ttd_walikota))
        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    TTD Walikota
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->ttd_walikota }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->ttd_walikota )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    TTD Walikota Salinan
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->produkHukum->ttd_walikota_salinan }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->produkHukum->ttd_walikota_salinan )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
            </div>
        </div>

        @if($draft->alur == 1)
        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
        @elseif($draft->alur == 0)
        <div class="d-grid gap-2 mt-4 mb-4">
            <a href="/dashboard/katalogprodukhukum" class="btn btn-secondary">Kembali</a>
        </div>
        @endif
        
    </div>
</div>
@endsection