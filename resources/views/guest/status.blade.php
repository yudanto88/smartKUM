@extends('guest.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="row mt-5">
    <div class="col-10 col-sm-8 col-md-8 col-lg-4 mx-auto position-relative">

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="row rounded p-4 login-page" style="background-color:#FFFFFF">
        <p class="text-center fs-3 mt-4">Cek Status Draft</p>
        <form action="/status" method="post">
          @csrf
          <div class="mt-4 form-input">
            <i class="fa-solid fa-magnifying-glass icon"></i>
            <input type="text" class="form-control input @error('status') is-invalid @enderror" name="status" id="status" placeholder="Masukkan No Regristrasi" value="{{ old('status') }}" autofocus>
          </div>
          <div>
            @error('status')
            <div class="text-danger">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>

          <div class="text-center mt-5">
            <button class="btn btn-info rounded-pill text-white fw-bold px-4" type="submit">Cari</button>
          </div>

          @if(isset($draft))
          <div class="text-center mt-3">
            <button class="btn btn-warning rounded-pill text-white fw-bold px-4" type="button" data-bs-toggle="modal" data-bs-target="#trayek{{$draft->id}}">
              Trayek
            </button>
          </div>

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
                                    {{date('d-m-Y', strtotime($draft->tanggal_pengajuan))}}
                                    {{date('H:i', strtotime($draft->created_at))}}
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">skpd</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if($draft->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">diajukan oleh {{$draft->user->name}}</p>
                                        </div>
                                    </div>
                                    @if($draft->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{ $draft->keterangan }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if($draft->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if($draft->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->status}} oleh {{$draft->draft_admins->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->draft->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->draft->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>

                            <!-- ADMIN FO -->
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if($draft->draft_admins->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>
                                    @endif

                                    @if($draft->draft_admins->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>
                                    @endif

                                    @if($draft->draft_admins->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if($draft->draft_admins->status == 'menunggu')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->updated_at))}}
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">admin fo</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if($draft->draft_admins->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->status}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($draft->draft_admins->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->status}} oleh {{$draft->draft_admins->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{ $draft->draft_admins->keterangan }} </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if($draft->draft_admins->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->status}} oleh {{$draft->draft_admins->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->draft->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{ $draft->draft_admins->draft->keterangan_penolakan }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                </div>
                            </div>

                            <!-- STAFF UU -->
                            @if(isset($draft->draft_admins->staffUndang->admin_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->status))
                                    @if($draft->draft_admins->staffUndang->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->status))
                                    @if($draft->draft_admins->staffUndang->status == 'menunggu')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">staff perundang-undangan</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->status))
                                    @if($draft->draft_admins->staffUndang->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->status}}</p>
                                        </div>
                                    </div>
                                    <!-- @if($draft->draft_admins->staffUndang->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif -->
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->status))
                                    @if($draft->draft_admins->staffUndang->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->status}} oleh {{$draft->draft_admins->staffUndang->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{ $draft->draft_admins->staffUndang->keterangan }} </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if($draft->draft_admins->staffUndang->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->status}} oleh {{$draft->draft_admins->staffUndang->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{ $draft->draft_admins->staffUndang->keterangan_penolakan }} </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- KASUBAG PERUNDANG-UNDANGAN -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->staff_undang_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->status == 'ditolak oleh kabag' || $draft->draft_admins->staffUndang->kasubagUndang->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->status == 'menunggu' || $draft->draft_admins->staffUndang->kasubagUndang->status == 'ditolak oleh kabag')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">kasubag perundang-undangan</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->status}}</p>
                                        </div>
                                    </div>      
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->status == 'ditolak oleh kabag')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->status}} {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- KABAG -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kasubag_undang_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'menunggu' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">kabag</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->status}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->status}} {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh sekda')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->status == 'ditolak oleh walikota')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->status}}</p>
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- KEPALA DINAS -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->kabag_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh walikota')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">kepala dinas</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status}}</p>
                                        </div>
                                    </div>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'diterima')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->keterangan)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->keterangan}}
                                        </div>
                                    </div>
                                    @endif

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh sekda')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}
                                        </div>
                                    </div>
                                    @endif

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status == 'ditolak oleh walikota')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status}} {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                        </div>
                                    </div>
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}
                                        </div>
                                    </div>
                                    @endif

                                    @else
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->status}}
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- SEKDA -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->kepala_dinas_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda-> updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">sekda</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'menunggu' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota' || $draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status}}</p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->validated}}
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'diterima')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->status == 'ditolak oleh walikota')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                </div>
                            </div>
                            @endif

                            <!-- WALIKOTA -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->sekda_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->updated_at))}}

                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">walikota</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status}}</p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0 mb-1">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->validated}}
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'diterima')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->status == 'ditolak')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-1" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->keterangan_penolakan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                </div>
                            </div>
                            @endif

                            <!-- STAFF DOKUMENTASI -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->updated_at))}}
                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">staff dokumentasi</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-0" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}}</p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->validated}}
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->walikota_id))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->status == 'diterima')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif

                                </div>
                            </div>
                            @endif

                            <!-- KASUBAG DOKUMENTASI -->
                            @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->staff_dokumentasi_id))
                            <div class="row border-top">
                                <div class="col-1 px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'diterima')
                                    <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                    <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                    @elseif($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'ditolak')
                                    <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-2 text-start px-0">
                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                    @else
                                    {{date('d-m-Y', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}
                                    {{date('H:i', strtotime($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->updated_at))}}

                                    @endif
                                    @endif
                                </div>
                                <div class="col-1 border-start px-0">
                                </div>
                                <div class="col text-start ps-0">
                                    <p class="text-uppercase fw-bold mb-0">kasubag dokumentasi</p>
                                    <p class="mb-0">Keterangan :</p>

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'menunggu')
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p class="mb-0" style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}}</p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status}} oleh {{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->validated}}
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(isset($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status))
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->produkHukum->status == 'diterima')
                                    @if($draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan != NULL)
                                    <div class="row">
                                        <div class="col-1 pe-0">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                        <div class="col ps-0">
                                            <p style="text-align: justify;">{{$draft->draft_admins->staffUndang->kasubagUndang->kabag->kepalaDinas->sekda->walikota->staffDokumentasi->keterangan}}</p>
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
          @endif

        </form>
      </div>
    </div>
  </div>
</div>
@endsection