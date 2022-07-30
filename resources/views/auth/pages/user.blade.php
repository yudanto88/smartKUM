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
                    <h1 class="h2">Daftar User</h1>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser">
                            Tambah User<i class="fa-solid fa-plus ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">User</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Role</th>
                        <th scope="col">Dinas</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($users as $user)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->nip}}</td>
                        <td>{{$user->role->role}}</td>
                        <td>{{$user->dinas->dinas}}</td>
                        <td>
                            <button type="button" class="badge bg-info border-0 mx-auto" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}" 
                            data-editemail="{{ $user->email }}" data-name="{{ $user->name }}" data-email="{{ $user->nip }}" 
                            data-roleid="{{ $user->role_id }}" data-dinasid="{{ $user->dinas_id }}" id="edit" onclick="getUser({{$user}})">
                                edit
                            </button>
                            <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteUser" id="delete" onclick="test()">
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

<!-- Modal Tambah User -->
<div class="modal fade " id="tambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/addUser" method="post">
      <div class="modal-body">
      
        @csrf
        <div class="fs-6">
            Email :
        </div>
        <input type="email" class="form-control input @error('email') is-invalid @enderror mt-2" 
        name="email" id="email" placeholder="naufalrm@gmail.com" value="{{ old('email') }}">
                    
        @error('email')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror
                    
        <div class="fs-6 mt-3">
            Password :
        </div>
        <input type="password" class="form-control input @error('password') is-invalid @enderror mt-2" 
        name="password" id="password" placeholder="******">
                    
        @error('password')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror
                    
        <div class="fs-6 mt-3">
            Confirm Password :
        </div>
        <input type="password" class="form-control input @error('confirmPassword') is-invalid @enderror mt-2" 
        name="confirmPassword" id="ConfirmPassword" placeholder="******">

        @error('confirmPassword')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

        <div class="fs-6 mt-3">
            Username :
        </div>
        <input type="text" class="form-control input @error('name') is-invalid @enderror mt-2" 
        name="name" id="name"  placeholder="Naufal Rizqullah" value="{{ old('name') }}">

        @error('name')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

        <div class="fs-6 mt-3">
            NIP :
        </div>
        <input type="number" class="form-control input @error('nip') is-invalid @enderror mt-2" 
        name="nip" id="nip"  placeholder="195150707111007" value="{{ old('nip') }}">

        @error('nip')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

        <div class="fs-6 mt-3">
            Pilih Role :
        </div>
        <select class="form-select mt-2 @error('role_id') is-invalid @enderror" aria-label="Default select example" 
        name="role_id" id="role_id">
        @foreach($role->skip(1) as $x)
        <option value="{{$x->id}}" {{ old('role_id') == $x->id ? 'selected' : null }} >{{$x->role}}</option>
        @endforeach
        </select>
        <div>
        @error('role_id')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror
        </div>

        <div class="fs-6 mt-3">
            Pilih Dinas :
        </div>
        <select class="form-select mt-2 @error('dinas_id') is-invalid @enderror" aria-label="Default select example" 
        name="dinas_id" id="dinas_id">
        @foreach($dinas as $x)
        <option value="{{$x->id}}" {{ old('dinas_id') == $x->id ? 'selected' : null }} >{{$x->dinas}}</option>
        @endforeach
        </select>
        <div>
        @error('dinas_id')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade " id="editUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/editUser/{{$user->id}}" method="post">
        @method('PUT')
        
      <div class="modal-body">
      
        @csrf
        <div class="fs-6">
            Email :
        </div>
        <input type="email" class="form-control input @error('edit_email') is-invalid @enderror mt-2" 
        name="edit_email" id="edit_email" >
                    
        @error('edit_email')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

        <div class="fs-6 mt-3">
            Confirm Username :
        </div>
        <input type="text" class="form-control input @error('edit_name') is-invalid @enderror mt-2" 
        name="edit_name" id="edit_name"  placeholder="Naufal Rizqullah">

        @error('edit_name')
        <div class="text-danger">
            <small>{{ $message }}</small> 
        </div>
        @enderror

        <div class="fs-6 mt-3">
            NIP :
        </div>
        <input type="number" class="form-control input @error('edit_nip') is-invalid @enderror mt-2" 
        name="edit_nip" id="edit_nip"  placeholder="195150707111007">

        @error('edit_nip')
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

@endsection

@section('js')
    @if($errors->any())
        <script>
			const modal = new bootstrap.Modal('#tambahUser', {keyboard:false});
			modal.show();
		</script>
    @endif
		
        <script>
            function getUser($userid){
                var inputan = document.getElementById('edit_email');
                inputan.value = $userid;
                alert($userid->email);
                // $('#edit_email').val($userid);
            }
            // $(document).ready(function(){
            //     $(document).on('click', '#delete', function(){
            //         var editemail = $(this).data('editemail');
            //         alert('email');
            //         $('#edit_email').value(editemail);

                    
            //     })
            // });
        </script>
        <script>
            function test(){
                alert('test');
            }
        </script>
@endsection