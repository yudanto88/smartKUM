@extends('guest.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="row mt-5 mb-5">
    <div class="col-10 col-sm-10 col-md-10 col-lg-12 mx-auto position-relative bg-light rounded p-3">
    <div class="row">
      <div class="col">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <img src="/img/bg/logo_jdih.png" alt="logo_jdih" class="p-2">
              <h1 class="h2 pe-2"> Daftar Katalog Produk Hukum Kota Batu</h1>
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
                          <td>
                              <div class="mx-auto">
                                <a href="/dashboard/readprodukhukum/{{$draft->id}}" class="badge bg-primary border-0 text-decoration-none">lihat</a>
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