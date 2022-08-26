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
                    <h1 class="h2"> Publikasi Produk Hukum</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableKasubagDokumentasi">
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
                            @foreach($draft->where('publikasi',1)->sortDesc() as $draft)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$draft->nomor}}</td>
                                <td>{{$draft->tahun}}</td>
                                <td>{{$draft->judul}}</td>
                                @if($draft->status_dokumen == 'mengganti')
                                <td>{{$draft->status_dokumen}} dokumen {{$draft->mengganti}}</td>
                                @else
                                <td>{{$draft->status_dokumen}}</td>
                                @endif
                                <td>{{$draft->jenis}}</td>
                                <td>{{date('d-m-Y', strtotime($draft->tanggal_pengundangan))}}</td>
                                <td>{{$draft->status}}</td>
                                <td>
                                    <div class="mx-auto">

                                        @if($draft->status == 'menunggu')
                                        <a href="/dashboard/kasubagd/editprodukhukum/{{$draft->id}}" class="badge bg-info border-0 text-decoration-none">edit</a>
                                        @endif

                                        @if($draft->status == 'diterima' || $draft->status == 'ditolak')
                                        <a href="/dashboard/kasubagd/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
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
        $('#tableKasubagDokumentasi').DataTable();
    } );
</script>
@endsection

@endsection