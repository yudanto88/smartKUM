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
                    <h1 class="h2">Daftar Jenis / Bentuk Peraturan</h1>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJenis">
                            Tambah Jenis<i class="fa-solid fa-plus ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableJenis">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenis as $j)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$j->jenis}}</td>
                        <td>
                            <button type="button" class="badge bg-info border-0 mx-auto" data-bs-toggle="modal" data-bs-target="#editJenis{{$j->id}}">
                                edit
                            </button>
                            <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteJenis{{$j->id}}">
                                delete
                            </button>

                            <!-- Modal Edit Jenis -->
                            <div class="modal fade " id="editJenis{{$j->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/editJenis/{{$j->id}}" method="post">
                                        @method('put')
                                    <div class="modal-body">
                                        @csrf
                                        <div class="fs-6">
                                            Jenis :
                                        </div>
                                        <input type="text" class="form-control input mt-2" 
                                        name="edit_jenis" id="edit_jenis" value="{{ $j->jenis }}">

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
                            <div class="modal fade " id="deleteJenis{{$j->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Dinas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/deleteJenis/{{$j->id}}" method="post">
                                        @method('delete')
                                    <div class="modal-body">
                                        @csrf
                                        Apakah yakin untuk menghapus jenis?
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

<!-- Modal Tambah Jenis -->
<div class="modal fade " id="tambahJenis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis / Bentuk Peraturan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/addJenis" method="post">
      <div class="modal-body">
      
        @csrf
        <div class="fs-6">
            Jenis :
        </div>
        <input type="text" class="form-control input @error('jenis') is-invalid @enderror mt-2" 
        name="jenis" id="jenis" value="{{ old('jenis') }}">

        @error('jenis')
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
        $('#tableJenis').DataTable();
    } );
</script>
@endsection

@endsection