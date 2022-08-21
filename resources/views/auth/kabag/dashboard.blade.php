@extends('auth.main')

@section('content')
<div class="row">
    <div class="col">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daftar Pengajuan Produk Hukum</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableKabag">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">No Regristrasi</th>
                                <th scope="col">Jenis / Bentuk Peraturan</th>
                                <th scope="col">Judul Produk Hukum</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($kabag as $draft)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$draft->kasubagUndang->staffUndang->admin->draft->no_regristrasi}}</td>
                                <td>{{$draft->kasubagUndang->staffUndang->admin->draft->jenis->jenis}}</td>
                                <td>{{$draft->kasubagUndang->staffUndang->admin->draft->judul}}</td>
                                <td>{{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan))}}</td>
                                <td>{{$draft->status}}</td>
                                <td>
                                    <div class="mx-auto">
                                        <button type="button" class="badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#trayek{{$draft->id}}">
                                            trayek
                                        </button>

                                        <!-- Modal Trayek -->
                                        <div class="modal fade " id="trayek{{$draft->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Trayek</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- SKPD -->
                                                        <div class="row">
                                                            <div class="col-1 px-0">
                                                                @if($draft->kasubagUndang->staffUndang->admin->draft->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->draft->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->draft->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan))}}
                                                                {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->admin->draft->created_at))}}
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">skpd</p>
                                                                <p class="mb-0">Keterangan :</p>
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">diajukan oleh {{$draft->kasubagUndang->staffUndang->admin->draft->user->name}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->draft->keterangan}}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- ADMIN FO -->
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->updated_at))}}
                                                                {{date('H:i', strtotime($draft->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->admin->updated_at))}}
                                                                {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->admin->updated_at))}}
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">admin fo</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->status}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->status}} oleh {{$draft->kasubagUndang->staffUndang->admin->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->admin->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->status}} oleh {{$draft->kasubagUndang->staffUndang->admin->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->admin->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        @if(isset($draft->kasubagUndang->staffUndang->admin_id))
                                                        <!-- STAFF UU -->
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if($draft->kasubagUndang->staffUndang->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->kasubagUndang->staffUndang->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->kasubagUndang->staffUndang->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if($draft->kasubagUndang->staffUndang->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->updated_at))}}
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">staff perundang-undangan</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if($draft->kasubagUndang->staffUndang->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->kasubagUndang->staffUndang->status}}</p>

                                                                    </div>
                                                                </div>

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        {{$draft->kasubagUndang->staffUndang->status}} oleh {{$draft->kasubagUndang->staffUndang->validated}}
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($draft->kasubagUndang->staffUndang->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{ $draft->kasubagUndang->staffUndang->keterangan }}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @endif

                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                3.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Staff perundang undangan
                                                                <div class="fs-7">
                                                                    @if($draft->kasubagUndang->staffUndang->status == 'menunggu')
                                                                    {{$draft->kasubagUndang->staffUndang->status}} pada {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->updated_at))}}
                                                                    @else
                                                                    {{$draft->kasubagUndang->staffUndang->status}} pada {{date('d-m-Y', strtotime($draft->kasubagUndang->staffUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->kasubagUndang->staffUndang->updated_at))}} oleh {{$draft->kasubagUndang->staffUndang->validated}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                4.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Kasubag perundang undangan
                                                                <div class="fs-7">
                                                                    @if($draft->kasubagUndang->status == 'menunggu' || $draft->kasubagUndang->status == 'ditolak oleh kabag')
                                                                    {{$draft->kasubagUndang->status}} pada {{date('d-m-Y', strtotime($draft->kasubagUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->kasubagUndang->updated_at))}}
                                                                    @else
                                                                    {{$draft->kasubagUndang->status}} pada {{date('d-m-Y', strtotime($draft->kasubagUndang->updated_at))}} pukul {{date('H:i', strtotime($draft->kasubagUndang->updated_at))}} oleh {{$draft->kasubagUndang->validated}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                5.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Kabag
                                                                <div class="fs-7">
                                                                    @if($draft->status == 'menunggu' || $draft->status == 'ditolak oleh sekda' || $draft->status == 'ditolak oleh walikota')
                                                                    {{$draft->status}} pada {{date('d-m-Y', strtotime($draft->updated_at))}} pukul {{date('H:i', strtotime($draft->updated_at))}}
                                                                    @else
                                                                    {{$draft->status}} pada {{date('d-m-Y', strtotime($draft->updated_at))}} pukul {{date('H:i', strtotime($draft->updated_at))}} oleh {{$draft->validated}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                6.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Kepala Dinas
                                                                <div class="fs-7">
                                                                    @if(isset($draft->kepalaDinas->status))
                                                                    @if($draft->kepalaDinas->status == 'menunggu' || $draft->kepalaDinas->status == 'ditolak oleh sekda')
                                                                    {{$draft->kepalaDinas->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->updated_at))}}
                                                                    @else
                                                                    {{$draft->kepalaDinas->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->updated_at))}} oleh {{$draft->kepalaDinas->validated}}
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                7.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Sekda
                                                                <div class="fs-7">
                                                                    @if(isset($draft->kepalaDinas->sekda->status))
                                                                    @if($draft->kepalaDinas->sekda->status == 'menunggu' || $draft->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                                                    {{$draft->kepalaDinas->sekda->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->updated_at))}}
                                                                    @else
                                                                    {{$draft->kepalaDinas->sekda->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->updated_at))}} oleh {{$draft->kepalaDinas->sekda->validated}}
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                8.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Walikota
                                                                <div class="fs-7">
                                                                    @if(isset($draft->kepalaDinas->sekda->walikota->status))
                                                                    @if($draft->kepalaDinas->sekda->walikota->status == 'menunggu')
                                                                    {{$draft->kepalaDinas->sekda->walikota->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->updated_at))}}
                                                                    @else
                                                                    {{$draft->kepalaDinas->sekda->walikota->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->updated_at))}} oleh {{$draft->kepalaDinas->sekda->walikota->validated}}
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                9.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Staff Dokumentasi
                                                                <div class="fs-7">
                                                                    @if(isset($draft->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                                    @if($draft->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                                                    {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                                    @else
                                                                    {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}} oleh {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->validated}}
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-1 fs-6">
                                                                10.
                                                            </div>
                                                            <div class="col-11 fs-6 text-start">
                                                                Kasubag Dokumentasi
                                                                <div class="fs-7">
                                                                    @if(isset($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                                    @if($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                                                    {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                                                    @else
                                                                    {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} pada {{date('d-m-Y', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} pukul {{date('H:i', strtotime($draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}} oleh {{$draft->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->validated}}
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($draft->status == 'menunggu' || $draft->status == 'ditolak oleh sekda' || $draft->status == 'ditolak oleh walikota')
                                        <a href="/dashboard/kabag/readprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                        @endif

                                        @if($draft->status == 'diterima' || $draft->status == 'ditolak')
                                        <a href="/dashboard/kabag/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableKabag').DataTable();
    });
</script>
@endsection

@endsection