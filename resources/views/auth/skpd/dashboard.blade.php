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
                        @foreach($drafts as $draft)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$draft->jenis}}</td>
                        <td>{{$draft->judul}}</td>
                        <td>{{$draft->tanggal_pengajuan}}</td>
                        <td>{{$draft->status}}</td>
                        <td>
                            <a href="/dashboard/skpd/editprodukhukum/{{$draft->id}}" class="badge bg-info border-0 mx-auto text-decoration-none">edit</a>
                            <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteDraft{{$draft->id}}">
                                delete
                            </button>

                            <!-- Modal Delete Draft -->
                            <div class="modal fade " id="deleteDraft{{$draft->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Draft Produk Hukum</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/skpd/deleteprodukhukum/{{$draft->id}}" method="post">
                                        @method('delete')
                                    <div class="modal-body">
                                        @csrf
                                        Apakah yakin untuk menghapus draft?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
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