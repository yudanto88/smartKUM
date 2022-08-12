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
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">No dan Tahun</th>
                        <th scope="col">tentang</th>
                        <th scope="col">Subjek</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Pengundangan</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($staff_dokumentasi->whereNull('walikota_id') as $draft)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$draft->produkHukum->no_tahun}}</td>
                        <td>{{$draft->produkHukum->tentang}}</td>
                        <td>{{$draft->produkHukum->subjek}}</td>
                        <td>{{$draft->produkHukum->status}}</td>
                        <td>{{$draft->produkHukum->tanggal_pengundangan}}</td>
                        <td>
                            <div class="mx-auto">
                                <button type="button" class="badge bg-warning border-0">
                                    trayek
                                </button>

                                @if($draft->status == 'menunggu' || $draft->status == 'ditolak')
                                <a href="/dashboard/staffd/editprodukhukumlama/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
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