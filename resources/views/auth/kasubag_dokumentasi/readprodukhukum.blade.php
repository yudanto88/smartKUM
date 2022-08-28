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
        <input type="text" class="form-control input mt-2" value="{{ $draft->nomor }}" readonly>

        <div class="fs-6 mt-3">
            Tahun
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->tahun }}" readonly>

        <div class="fs-6 mt-3">
            Judul
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->judul }}" readonly>
        
        <div class="fs-6 mt-3">
            SKPD Pemrakarsa
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->pemrakarsa }}" readonly>

        @if($draft->status_dokumen == 'berlaku' || $draft->status_dokumen == 'dicabut')
        <div class="fs-6 mt-3">
            Status Dokumen
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->status_dokumen }}" readonly>
        @else
        <div class="fs-6 mt-3">
            Status Dokumen
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->status_dokumen }} dokumen {{ $draft->mengganti }}" readonly>
        @endif
            
        <div class="fs-6 mt-3">
            Status
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->status }}" readonly>

        <div class="fs-6 mt-3">
            jenis / Bentuk Peraturan
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->jenis }}" readonly>

        @if(isset($draft->subjek))
        <div class="fs-6 mt-3">
            Subjek
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->subjek }}" readonly>
        @endif

        @if(isset($draft->sumber))
        <div class="fs-6 mt-3">
            Sumber
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->sumber }}" readonly>
        @endif

        <div class="fs-6 mt-3">
            No Regristrasi
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->no_regristrasi }}" readonly>

        @if(isset($draft->bidang_hukum))
        <div class="fs-6 mt-3">
            Bidang Hukum
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->bidang_hukum }}" readonly>
        @endif

         <div class="row">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                <div class="fs-6 mt-3">
                    Tanggal Pengundangan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->tanggal_pengundangan }}" readonly>
                </div> 
            </div>

        <div class="fs-6 mt-3">
            Keterangan Staff Dokumentasi
        </div>
        <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->staffDokumentasi->keterangan }}</Textarea>

        @if(isset($draft->staffDokumentasi->walikota->sekda->persetujuan))
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
                                <input type="text" value="{{ $draft->staffDokumentasi->walikota->sekda->persetujuan }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->staffDokumentasi->walikota->sekda->persetujuan )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($draft->staffDokumentasi->walikota->ttd_walikota))
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
                                <input type="text" value="{{ $draft->staffDokumentasi->walikota->ttd_walikota }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->staffDokumentasi->walikota->ttd_walikota )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
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
                                <input type="text" value="{{ $draft->ttd_walikota_salinan }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->ttd_walikota_salinan )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
            </div>
        </div>

        @if($draft->status == 'menunggu')
        <form action="/dashboard/kasubagd/process/{{$draft->id}}" method="post">
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