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
                    <table class="table table-striped table-sm" id="tableAdmin">
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
                        <tbody class="">
                            @foreach($admins->sortDesc() as $draft)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$draft->draft->no_regristrasi}}</td>
                                <td>{{$draft->draft->jenis->jenis}}</td>
                                <td>{{$draft->draft->judul}}</td>
                                <td>{{date('d-m-Y', strtotime($draft->draft->tanggal_pengajuan))}}</td>
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
                                                                @if($draft->draft->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>
                                                                @endif

                                                                @if($draft->draft->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>
                                                                @endif

                                                                @if($draft->draft->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                {{date('d-m-Y', strtotime($draft->draft->tanggal_pengajuan))}}
                                                                {{date('H:i', strtotime($draft->draft->created_at))}}
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">skpd</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if($draft->draft->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">diajukan oleh {{$draft->draft->user->name}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->draft->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{ $draft->draft->keterangan }}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if($draft->draft->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->draft->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($draft->draft->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->draft->status}} oleh {{$draft->draft->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->draft->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->draft->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- ADMIN FO -->
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if($draft->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>
                                                                @endif

                                                                @if($draft->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>
                                                                @endif

                                                                @if($draft->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if($draft->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->updated_at))}}
                                                                {{date('H:i', strtotime($draft->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->updated_at))}}
                                                                {{date('H:i', strtotime($draft->updated_at))}}
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">admin fo</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if($draft->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->status}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($draft->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->status}} oleh {{$draft->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{ $draft->keterangan }} </p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if($draft->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->status}} oleh {{$draft->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->draft->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{ $draft->keterangan_penolakan }}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <!-- STAFF UU -->
                                                        @if(isset($draft->staffUndang->admin_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->status))
                                                                @if($draft->staffUndang->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->status))
                                                                @if($draft->staffUndang->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">staff perundang-undangan</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->status))
                                                                @if($draft->staffUndang->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->status}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->status))
                                                                @if($draft->staffUndang->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->status}} oleh {{$draft->staffUndang->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{ $draft->staffUndang->keterangan }} </p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif
                                                                
                                                                @if(isset($draft->staffUndang->status))
                                                                @if($draft->staffUndang->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->status}} oleh {{$draft->staffUndang->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{ $draft->staffUndang->keterangan_penolakan }} </p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif


                                                        <!-- KASUBAG PERUNDANG-UNDANGAN -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->staff_undang_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->status))
                                                                @if($draft->staffUndang->kasubagUndang->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->status == 'ditolak oleh kabag' || $draft->staffUndang->kasubagUndang->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->status))
                                                                @if($draft->staffUndang->kasubagUndang->status == 'menunggu' || $draft->staffUndang->kasubagUndang->status == 'ditolak oleh kabag')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">kasubag perundang-undangan</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->status))
                                                                @if($draft->staffUndang->kasubagUndang->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->status}}</p>
                                                                    </div>
                                                                </div>      
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->status))
                                                                @if($draft->staffUndang->kasubagUndang->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->status}} oleh {{$draft->staffUndang->kasubagUndang->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @elseif($draft->staffUndang->kasubagUndang->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->status}} oleh {{$draft->staffUndang->kasubagUndang->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @elseif($draft->staffUndang->kasubagUndang->status == 'ditolak oleh kabag')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->status}} {{$draft->staffUndang->kasubagUndang->kabag->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- KABAG -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kasubag_undang_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->status == 'ditolak' || $draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda' || $draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'menunggu' || $draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda' || $draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">kabag</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->status}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->status}} {{$draft->staffUndang->kasubagUndang->kabag->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->status}}</p>
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- KEPALA DINAS -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->kabag_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh walikota')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu' || $draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">kepala dinas</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status}}</p>
                                                                    </div>
                                                                </div>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'diterima')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->keterangan)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->keterangan}}
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh walikota')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                                                    </div>
                                                                </div>
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->status}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- SEKDA -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->kepala_dinas_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak' || $draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu' || $draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda-> updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">sekda</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu' || $draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota' || $draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status}}</p>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'diterima')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                
                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- WALIKOTA -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->sekda_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}

                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">walikota</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status}}</p>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0 mb-1">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->validated}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'diterima')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'ditolak')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-1" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- STAFF DOKUMENTASI -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">staff dokumentasi</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}}</p>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->validated}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'diterima')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <!-- KASUBAG DOKUMENTASI -->
                                                        @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->staff_dokumentasi_id))
                                                        <div class="row border-top">
                                                            <div class="col-1 px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'diterima')
                                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                                @elseif($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'ditolak')
                                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-2 text-start px-0">
                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                                                @else
                                                                {{date('d-m-Y', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                                                {{date('H:i', strtotime($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}

                                                                @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-1 border-start px-0">
                                                            </div>
                                                            <div class="col text-start ps-0">
                                                                <p class="text-uppercase fw-bold mb-0">kasubag dokumentasi</p>
                                                                <p class="mb-0">Keterangan :</p>

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p class="mb-0" style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}}</p>
                                                                    </div>
                                                                </div>

                                                                @else
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} oleh {{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->validated}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif

                                                                @if(isset($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'diterima')
                                                                @if($draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan != NULL)
                                                                <div class="row">
                                                                    <div class="col-1 pe-0">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <p style="text-align: justify;">{{$draft->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @endif
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($draft->status == 'menunggu')
                                        <a href="/dashboard/admin/readprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                        @endif

                                        @if($draft->status == 'ditolak' || $draft->status == 'diterima')
                                        <a href="/dashboard/admin/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
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
        $('#tableAdmin').DataTable();
    });
</script>
@endsection

@endsection