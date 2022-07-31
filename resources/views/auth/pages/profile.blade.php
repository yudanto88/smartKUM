@extends('auth.main')

@section('content')
@if(session()->has('success'))  
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  {{ session()->get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Profile</h1>
</div>
<div class="row">
    <div class="col">
        <form action="/dashboard/editProfile/{{$user->id}}" method="post">
            @method('put')
            @csrf
            <div class="fs-6">
                Email :
            </div>
            <input type="email" class="form-control input @error('email') is-invalid @enderror mt-2" 
            name="email" id="email" placeholder="naufalrm@gmail.com" value="{{ old('email', $user->email) }}">
                    
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
            name="name" id="name"  placeholder="Username" value="{{ old('name', $user->name) }}">

            @error('name')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror

            <div class="fs-6 mt-3">
                NIP :
            </div>
            <input type="number" class="form-control input @error('nip') is-invalid @enderror mt-2" 
            name="nip" id="nip"  placeholder="NIP" value="{{ old('nip', $user->nip) }}">

            @error('nip')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror

            <div class="fs-6 mt-3">
                Pilih Dinas :
            </div>
            <select class="form-select mt-2 @error('dinas_id') is-invalid @enderror" aria-label="Default select example" 
            name="dinas_id" id="dinas-id">
            @foreach($dinas as $x)
            <option value="{{$x->id}}" {{ $user->dinas_id == $x->id ? 'selected' : null }} >{{$x->dinas}}</option>
            @endforeach
            </select>
            <div>
            @error('dinas_id')
            <div class="text-danger">
                <small>{{ $message }}</small> 
            </div>
            @enderror
            </div>

            <div class="d-grid gap-2 mt-4 mb-3">
            <button class="btn btn-primary fw-bold" type="submit">edit profile</button>
            </div>
        </form>
    </div>
</div>
@endsection