@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengisian Metadata</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/staffd/process/{{$draft->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="fs-6">
                Nomor
            </div>

            @if(isset($draft->produkHukum->nomor))
            <input type="number" class="form-control input @error('nomor') is-invalid @enderror mt-2" 
            name="nomor" id="nomor" value="{{ old('nomor', $draft->produkHukum->nomor) }}">
            @else
            <input type="number" class="form-control input @error('nomor') is-invalid @enderror mt-2" 
            name="nomor" id="nomor" value="{{ old('nomor') }}">
            @endif

            @error('nomor')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Tahun
            </div>

            @if(isset($draft->produkHukum->tahun))
            <input type="number" class="form-control input @error('tahun') is-invalid @enderror mt-2" 
            name="tahun" id="tahun" value="{{  old('tahun', $draft->produkHukum->tahun) }}">
            @else
            <input type="number" class="form-control input @error('tahun') is-invalid @enderror mt-2" 
            name="tahun" id="tahun" value="{{  old('tahun') }}">
            @endif

            @error('tahun')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Judul
            </div>

            @if(isset($draft->produkHukum->judul))
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id ="judul" value="{{ old('judul', $draft->produkHukum->judul) }}">
            @else
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id ="judul" value="{{ old('judul', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->judul) }}">
            @endif

            @error('judul')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                SKPD Pemrakarsa
            </div>

            @if(isset($draft->produkHukum->pemrakarsa))
            <input type="text" class="form-control input mt-2" name="pemrakarsa" id ="pemrakarsa" 
            value="{{ old('pemrakarsa', $draft->produkHukum->pemrakarsa) }}" readonly>
            @else
            <input type="text" class="form-control mt-2" name="pemrakarsa" id ="pemrakarsa" 
            value="{{ old('pemrakarsa', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->user->dinas->dinas) }}" readonly>
            @endif

            <div class="fs-6 mt-3">
                Status Dokumen
            </div>
            <select class="form-select mt-2" aria-label="Default select example" 
            name="status_dokumen" id="status_dokumen">
            <option value="berlaku" selected>Berlaku</option>
            <option value="mengganti">Mengganti</option>
            </select>

            <div class="fs-6 mt-3" name="text_mengganti" id="text_mengganti">
                Mengganti Produk Hukum
            </div>

            <select class="form-select mt-2" aria-label="Default select example" 
            name="mengganti" id="mengganti">
            @foreach($draftAll->except($draft->id) as $x)
            <option value="{{$x->judul}}">{{$x->judul}}</option>
            @endforeach
            </select>
            
            <div class="fs-6 mt-3">
                Status
            </div>

            @if(isset($draft->produkHukum->status))
            <input type="text" class="form-control input mt-2" name="status" id ="status" value="{{ $draft->produkHukum->status }}" readonly>
            @else
            <input type="text" class="form-control input mt-2" name="status" id ="status" value="{{ $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->status }}" readonly>
            @endif

            <div class="fs-6 mt-3">
                Jenis / Bentuk Peraturan 
            </div>

            @if(isset($draft->produkHukum->jenis))
            <input type="text" class="form-control input mt-2" name="jenis" id ="jenis" 
            value="{{ old('jenis', $draft->produkHukum->jenis) }}" readonly>
            @else
            <input type="text" class="form-control input mt-2" name="jenis" id ="jenis" 
            value="{{ old('jenis', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->jenis->jenis) }}" readonly>
            @endif

            <div class="fs-6 mt-3">
                Subjek
            </div>

            @if(isset($draft->produkHukum->subjek))
            <input type="text" class="form-control input @error('subjek') is-invalid @enderror mt-2" 
            name="subjek" id="subjek" value="{{  old('subjek', $draft->produkHukum->subjek) }}">
            @else
            <input type="text" class="form-control input @error('subjek') is-invalid @enderror mt-2" 
            name="subjek" id="subjek" value="{{  old('subjek') }}">
            @endif

            @error('subjek')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Sumber
            </div>

            @if(isset($draft->produkHukum->sumber))
            <input type="text" class="form-control input @error('sumber') is-invalid @enderror mt-2" 
            name="sumber" id="sumber" value="{{  old('sumber', $draft->produkHukum->sumber) }}">
            @else
            <input type="text" class="form-control input @error('sumber') is-invalid @enderror mt-2" 
            name="sumber" id="sumber" value="{{  old('sumber') }}">
            @endif

            @error('sumber')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                No Regristrasi
            </div>

            @if(isset($draft->produkHukum->no_regristrasi))
            <input type="text" class="form-control input mt-2" name="no_regristrasi" id ="no_regristrasi" 
            value="{{ old('no_regristrasi', $draft->produkHukum->no_regristrasi) }}" readonly>
            @else
            <input type="text" class="form-control mt-2" name="no_regristrasi" id ="no_regristrasi" 
            value="{{ old('no_regristrasi', $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->no_regristrasi) }}" readonly>
            @endif

            <div class="fs-6 mt-3">
                Bidang Hukum
            </div>

            @if(isset($draft->produkHukum->bidang_hukum))
            <input type="text" class="form-control input @error('bidang_hukum') is-invalid @enderror mt-2" 
            name="bidang_hukum" id="bidang_hukum" value="{{  old('bidang_hukum', $draft->produkHukum->bidang_hukum) }}">
            @else
            <input type="text" class="form-control input @error('bidang_hukum') is-invalid @enderror mt-2" 
            name="bidang_hukum" id="bidang_hukum" value="{{  old('bidang_hukum') }}">
            @endif

            @error('bidang_hukum')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="row">
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-3">
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
            @else
            <div class="row">
                <div class="col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="fs-6 mt-3">
                        Upload Persetujuan Sekda
                    </div>
                    <input type="file" class="form-control input @error('persetujuan') is-invalid @enderror mt-2" 
                    name="persetujuan" id="persetujuan">

                    @error('persetujuan')
                    <div class="text-danger">
                        <small>{{ $message }}</small> 
                    </div>
                    @enderror
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
            @else
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
            </div>
            @endif

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
                    <div class="row">
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

@section('js')
<script>
    $('#mengganti').hide();
    $('#text_mengganti').hide();
    $('#status_dokumen').on('change', function(){
        var jenis = $(this).val();
        if(jenis == 'mengganti'){
            $('#mengganti').show(400);
            $('#text_mengganti').show(400);
        }else{
            $('#mengganti').hide(400);
            $('#text_mengganti').hide(400);
        }
    })
</script>
@endsection

@endsection