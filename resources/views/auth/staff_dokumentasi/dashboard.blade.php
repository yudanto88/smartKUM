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
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Jenis / Bentuk Peraturan</th>
                        <th scope="col">Judul Produk Hukum</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($staff_dokumentasi->whereNotNull('walikota_id') as $draft)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->jenis}}</td>
                        <td>{{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->judul}}</td>
                        <td>{{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan}}</td>
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
                                        <div class="row">
                                            <div class="col-1 fs-6">
                                            1. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Operator SKPD 
                                                <div class="fs-7">
                                                    Diajukan pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->tanggal_pengajuan}} oleh {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->draft->user->name}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            2. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Admin FO 
                                                <div class="fs-7">
                                                    @if($draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->status == 'menunggu')
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->updated_at}} oleh {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->admin->validated}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-1 fs-6">
                                            3. 
                                            </div>
                                            <div class="col-11 fs-6 text-start">
                                            Staff perundang undangan 
                                                <div class="fs-7">
                                                    @if($draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->status == 'menunggu')
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->updated_at}} oleh {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->staffUndang->validated}}
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
                                                    @if($draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->status == 'menunggu' || $draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->status == 'ditolak oleh kabag')
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->updated_at}} oleh {{$draft->walikota->sekda->kepalaDinas->kabag->kasubagUndang->validated}}
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
                                                    @if($draft->walikota->sekda->kepalaDinas->kabag->status == 'menunggu' || $draft->walikota->sekda->kepalaDinas->kabag->status == 'ditolak oleh sekda' || $draft->walikota->sekda->kepalaDinas->kabag->status == 'ditolak oleh walikota')
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->kepalaDinas->kabag->status}} pada {{$draft->walikota->sekda->kepalaDinas->kabag->updated_at}} oleh {{$draft->walikota->sekda->kepalaDinas->kabag->validated}}
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
                                                    @if($draft->walikota->sekda->kepalaDinas->status == 'menunggu' || $draft->walikota->sekda->kepalaDinas->status == 'ditolak oleh sekda')
                                                    {{$draft->walikota->sekda->kepalaDinas->status}} pada {{$draft->walikota->sekda->kepalaDinas->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->kepalaDinas->status}} pada {{$draft->walikota->sekda->kepalaDinas->updated_at}} oleh {{$draft->walikota->sekda->kepalaDinas->validated}}
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
                                                    @if($draft->walikota->sekda->status == 'menunggu' || $draft->walikota->sekda->status == 'ditolak oleh walikota')
                                                    {{$draft->walikota->sekda->status}} pada {{$draft->walikota->sekda->updated_at}}
                                                    @else
                                                    {{$draft->walikota->sekda->status}} pada {{$draft->walikota->sekda->updated_at}} oleh {{$draft->walikota->sekda->validated}}
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
                                                    @if($draft->walikota->status == 'menunggu')
                                                    {{$draft->walikota->status}} pada {{$draft->walikota->updated_at}}
                                                    @else
                                                    {{$draft->walikota->status}} pada {{$draft->walikota->updated_at}} oleh {{$draft->walikota->validated}}
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
                                                    @if(isset($draft->walikota_id))
                                                        @if($draft->status == 'menunggu')
                                                        {{$draft->status}} pada {{$draft->updated_at}}
                                                        @else
                                                        {{$draft->status}} pada {{$draft->updated_at}} oleh {{$draft->validated}}
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
                                                    @if(isset($draft->produkHukum->status))
                                                        @if($draft->produkHukum->status == 'menunggu')
                                                        {{$draft->produkHukum->status}} pada {{$draft->produkHukum->updated_at}}
                                                        @else
                                                        {{$draft->produkHukum->status}} pada {{$draft->produkHukum->updated_at}} oleh {{$draft->produkHukum->validated}}
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

                                @if($draft->status == 'menunggu' || $draft->status == 'ditolak')
                                <a href="/dashboard/staffd/editprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                @endif

                                @if($draft->status == 'diterima')
                                    <a href="/dashboard/staffd/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
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
@endsection