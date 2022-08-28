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
                Nomor
            </div>
            <input type="number" class="form-control input @error('nomor') is-invalid @enderror mt-2" 
            name="nomor" id="nomor" value="{{ old('nomor') }}">

            @error('nomor')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Tahun
            </div>
            <input type="number" class="form-control input @error('tahun') is-invalid @enderror mt-2" 
            name="tahun" id="tahun" value="{{  old('tahun') }}">

            @error('tahun')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Judul
            </div>
            <input type="text" class="form-control input @error('judul') is-invalid @enderror mt-2" 
            name="judul" id ="judul" value="{{ old('judul') }}">

            @error('judul')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                SKPD Pemrakarsa
            </div>
            <input type="text" class="form-control input @error('pemrakarsa') is-invalid @enderror mt-2" 
            name="pemrakarsa" id ="pemrakarsa" value="{{ old('pemrakarsa') }}">

            @error('pemrakarsa')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

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
            @foreach($draftAll as $x)
            <option value="{{$x->judul}}">{{$x->judul}}</option>
            @endforeach
            </select>

            <div class="fs-6 mt-3">
                Jenis / Bentuk Peraturan 
            </div>
            <select class="form-select mt-2" aria-label="Default select example" 
            name="jenis" id="jenis">
            @foreach($jenis as $x)
            <option value="{{$x->jenis}}" {{ old('jenis') == $x->id ? 'selected' : null }} >{{$x->jenis}}</option>
            @endforeach
            </select>

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

            <div class="fs-6 mt-3">
                Sumber
            </div>
            <input type="text" class="form-control input mt-2" name="sumber" id ="sumber" 
            value="{{ old('sumber') }}">

            @error('sumber')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                No Regristrasi
            </div>
            <input type="text" class="form-control input mt-2" name="no_regristrasi" id ="no_regristrasi" 
            value="{{ old('no_regristrasi') }}">

            @error('no_regristrasi')
                <div class="text-danger">
                    <small>{{ $message }}</small> 
                </div>
            @enderror

            <div class="fs-6 mt-3">
                Bidang Hukum
            </div>
            <input type="text" class="form-control input mt-2" name="bidang_hukum" id ="bidang_hukum" 
            value="{{ old('bidang_hukum') }}">

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