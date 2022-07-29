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

                        <tr>
                        <td>1</td>
                        <td>Perdes</td>
                        <td>Perdes A</td>
                        <td>06 / 05 / 2001</td>
                        <td>Sedang diajukan</td>
                        <td>
                            <button type="button" class="badge bg-info border-0 mx-auto">
                                edit
                            </button>
                            <button type="button" class="badge bg-danger border-0">
                                delete
                            </button>
                        </td>
                        </tr>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection