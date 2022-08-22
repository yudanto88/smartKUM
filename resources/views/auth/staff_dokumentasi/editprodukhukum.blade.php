@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Produk Hukum</h1>
</div>
<div class="row">
    <div class="col">
        <div class="fs-6">
            Operator SKPD
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->user->name }}" readonly>

        <div class="fs-6 mt-3">
            Jenis / Bentuk Peraturan 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->jenis->jenis }}" readonly>

        <div class="fs-6 mt-3">
            Judul Produk Hukum 
        </div>
        <input type="text" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->judul }}" readonly>

        <div class="row">
            <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                <div class="fs-6 mt-3">
                    Tanggal Pengajuan
                </div>
                <input type="date" class="form-control input mt-2" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan }}" readonly>
            </div>
        </div>

        <div class="fs-6 mt-3">
            Keterangan Walikota
        </div>
        <textarea type="text" class="form-control input mt-2" style="height:100px" readonly>{{ $draft->walikota->keterangan }}</Textarea>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Surat Pengajuan
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->surat_pengajuan }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->surat_pengajuan )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->surat_pengajuan)}}" class="btn btn-primary mt-2">Download</a> -->
            </div>
        </div>

        <div class="row">
            <div class="col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum
                </div>
                <div class="row mt-2">
                    <div class="col-10 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-9 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                <input type="text" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum)}}" class="btn btn-primary mt-2">Download</a> -->
            </div>
            @if($draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama)
            <div class="col">
                <div class="fs-6 mt-3">
                    Draft Produk Hukum Lama
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->draft_produk_hukum_lama)}}" class="btn btn-primary mt-2">Download</a> -->
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    Revisi Produk Hukum
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->revisi_produk_hukum }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->revisi_produk_hukum )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->revisi_produk_hukum)}}" class="btn btn-primary mt-2">Download</a> -->
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="fs-6 mt-3">
                    NPKND
                </div>
                <div class="row mt-2">
                    <div class="col-11 col-sm-8 col-md-7 col-lg-8 col-xl-8 rounded-3 border-1 border border-dark px-2 py-2 ms-3" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col-1">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div class="col-10">
                                <input type="text" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->npknd }}" style="border: none; background-color: #e9ecef; width: 105%;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->npknd )}}" class="ms-2" style="vertical-align: -webkit-baseline-middle">Download</a>
                    </div>
                </div>
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->npknd)}}" class="btn btn-primary mt-2">Download</a> -->
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
                <!-- <a href="{{ asset('storage/' . $draft->walikota->sekda->persetujuan)}}" class="btn btn-primary mt-2">Download</a> -->
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

        <div class="row justify-content-end mt-4 mb-4">
            <div class="col-3">
                <div class="d-grid gap-2">
                    <a href="/dashboard/staffd/metadata/{{$draft->id}}" class="btn btn-primary mt-2">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection