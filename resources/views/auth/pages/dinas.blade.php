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
    @if(session()->has('error'))  
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      {{ session()->get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daftar Dinas</h1>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDinas">
                            Tambah Dinas<i class="fa-solid fa-plus ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableDinas">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Dinas</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dinas as $d)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->dinas}}</td>
                        <td>
                            <button type="button" class="badge bg-info border-0 mx-auto" data-bs-toggle="modal" data-bs-target="#editDinas{{$d->id}}">
                                edit
                            </button>
                            <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteDinas{{$d->id}}">
                                delete
                            </button>

                            <!-- Modal Edit Dinas -->
                            <div class="modal fade " id="editDinas{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Dinas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/editDinas/{{$d->id}}" method="post">
                                        @method('put')
                                    <div class="modal-body">
                                        @csrf
                                        <div class="fs-6">
                                            Dinas :
                                        </div>
                                        <input type="text" class="form-control input mt-2" 
                                        name="edit_dinas" id="edit_dinas" value="{{ $d->dinas }}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete Dinas -->
                            <div class="modal fade " id="deleteDinas{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Dinas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/deleteDinas/{{$d->id}}" method="post">
                                        @method('delete')
                                    <div class="modal-body">
                                        @csrf
                                        Apakah yakin untuk menghapus dinas?
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

<!-- Modal Tambah Dinas -->
<div class="modal fade " id="tambahDinas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Dinas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/addDinas" method="post">
      <div class="modal-body">
      
        @csrf
        <div class="fs-6">
            Dinas :
        </div>
        <input type="text" class="form-control input @error('dinas') is-invalid @enderror mt-2" 
        name="dinas" id="dinas" placeholder="Dinas Sosial" value="{{ old('dinas') }}">

        @error('dinas')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

@if($errors->has('dinas'))
	@section('js')
		<script>
			const modal = new bootstrap.Modal('#tambahDinas', {keyboard:false});
			modal.show();
		</script>
	@endsection
@endif

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableDinas').DataTable();
    } );
</script>
@endsection

@endsection