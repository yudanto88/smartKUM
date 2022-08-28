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
                    <h1 class="h2">Produk Hukum Lama</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableKatalog">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Keterangan Dokumen</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tanggal Pengundangan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff_dokumentasi->where('alur',0)->sortDesc() as $draft)
                        @if(isset($draft->produkHukum))
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$draft->produkHukum->nomor}}</td>
                        <td>{{$draft->produkHukum->tahun}}</td>
                        <td>{{$draft->produkHukum->judul}}</td>
                        @if($draft->produkHukum->status_dokumen == 'mengganti')
                        <td>{{$draft->produkHukum->status_dokumen}} dokumen {{$draft->produkHukum->mengganti}}</td>
                        @else
                        <td>{{$draft->produkHukum->status_dokumen}}</td>
                        @endif
                        <td>{{$draft->produkHukum->jenis}}</td>
                        <td>{{date('d-m-Y', strtotime($draft->produkHukum->tanggal_pengundangan))}}</td>
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
                                        
                                        <!-- STAFF DOKUMENTASI -->
                                        @if(isset($draft->walikota_id))
                                        <div class="row border-top">
                                            <div class="col-1 px-0">
                                                @if(isset($draft->walikota_id))
                                                @if($draft->status == 'diterima')
                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                @elseif($draft->status == 'menunggu')
                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                @elseif($draft->status == 'ditolak')
                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                @endif
                                                @endif
                                            </div>
                                            <div class="col-2 text-start px-0">
                                                @if(isset($draft->walikota_id))
                                                @if($draft->status == 'menunggu')
                                                {{date('d-m-Y', strtotime($draft->updated_at))}}
                                                {{date('H:i', strtotime($draft->updated_at))}}
                                                @else
                                                {{date('d-m-Y', strtotime($draft->updated_at))}}
                                                {{date('H:i', strtotime($draft->updated_at))}}
                                                @endif
                                                @endif
                                            </div>
                                            <div class="col-1 border-start px-0">
                                            </div>
                                            <div class="col text-start ps-0">
                                                <p class="text-uppercase fw-bold mb-0">staff dokumentasi</p>
                                                <p class="mb-0">Keterangan :</p>

                                                @if(isset($draft->walikota_id))
                                                @if($draft->status == 'menunggu')
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        <p class="mb-0" style="text-align: justify;">{{$draft->status}}</p>
                                                    </div>
                                                </div>

                                                @else
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        {{$draft->status}} oleh {{$draft->validated}}
                                                    </div>
                                                </div>
                                                @endif
                                                @endif

                                                @if(isset($draft->walikota_id))
                                                @if($draft->status == 'diterima')
                                                @if($draft->keterangan != NULL)
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        <p style="text-align: justify;">{{$draft->keterangan}}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                        <!-- KASUBAG DOKUMENTASI -->
                                        @if(isset($draft->produkHukum->staff_dokumentasi_id))
                                        <div class="row border-top">
                                            <div class="col-1 px-0">
                                                @if(isset($draft->produkHukum->status))
                                                @if($draft->produkHukum->status == 'diterima')
                                                <i class="fa-solid fa-circle" style="color: #198754;"></i>

                                                @elseif($draft->produkHukum->status == 'menunggu')
                                                <i class="fa-solid fa-circle" style="color: #ffc107;"></i>

                                                @elseif($draft->produkHukum->status == 'ditolak')
                                                <i class="fa-solid fa-circle" style="color: #dc3545;"></i>
                                                @endif
                                                @endif
                                            </div>
                                            <div class="col-2 text-start px-0">
                                                @if(isset($draft->produkHukum->status))
                                                @if($draft->produkHukum->status == 'menunggu')
                                                {{date('d-m-Y', strtotime($draft->produkHukum->updated_at))}}
                                                {{date('H:i', strtotime($draft->produkHukum->updated_at))}}
                                                @else
                                                {{date('d-m-Y', strtotime($draft->produkHukum->updated_at))}}
                                                {{date('H:i', strtotime($draft->produkHukum->updated_at))}}

                                                @endif
                                                @endif
                                            </div>
                                            <div class="col-1 border-start px-0">
                                            </div>
                                            <div class="col text-start ps-0">
                                                <p class="text-uppercase fw-bold mb-0">kasubag dokumentasi</p>
                                                <p class="mb-0">Keterangan :</p>

                                                @if(isset($draft->produkHukum->status))
                                                @if($draft->produkHukum->status == 'menunggu')
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        <p class="mb-0" style="text-align: justify;">{{$draft->produkHukum->status}}</p>
                                                    </div>
                                                </div>

                                                @else
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        {{$draft->produkHukum->status}} oleh {{$draft->produkHukum->validated}}
                                                    </div>
                                                </div>
                                                @endif
                                                @endif

                                                @if(isset($draft->produkHukum->status))
                                                @if($draft->produkHukum->status == 'diterima')
                                                @if($draft->keterangan != NULL)
                                                <div class="row">
                                                    <div class="col-1 pe-0">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </div>
                                                    <div class="col ps-0">
                                                        <p style="text-align: justify;">{{$draft->keterangan}}</p>
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

                                @if($draft->status == 'menunggu' || $draft->status == 'ditolak')
                                <a href="/dashboard/staffd/editkatalogprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                @endif

                                @if($draft->status == 'diterima')
                                    <a href="/dashboard/staffd/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
                                @endif
                            </div>
                        </td>
                        </tr>
                        @endif
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
        $('#tableKatalog').DataTable();
    } );
</script>
@endsection

@endsection