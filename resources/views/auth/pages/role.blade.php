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
          <h1 class="h2">Daftar Role</h1>
          <div class="mt-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRole">
              Tambah Role<i class="fa-solid fa-plus ms-2"></i>
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($role->skip(1) as $roles)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$roles->role}}</td>
            <td>
              <button type="button" class="badge bg-info border-0 mx-auto">
                edit
              </button>
              <button type="button" class="badge bg-danger border-0">
                delete
              </button>
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
        
<!-- Modal Tambah Role -->
<div class="modal fade " id="tambahRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/addRole" method="post">
      <div class="modal-body">
      
        @csrf
        <div class="fs-6">
            Role :
        </div>
        <input type="text" class="form-control input @error('role') is-invalid @enderror mt-2" 
        name="role" id="role" placeholder="skpd" value="{{ old('role') }}">

        @error('role')
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

@if($errors->any())
	@section('js')
		<script>
			const modal = new bootstrap.Modal('#tambahRole', {keyboard:false});
			modal.show();
		</script>
	@endsection
@endif

@endsection