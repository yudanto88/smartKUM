@extends('guest.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="container position-relative">
  <div class="row mt-2 mb-4">
    <div class="col-4 mx-auto p-4 rounded register-page" style="background-color:#FFFFFF">
      <p class="text-center fs-3">Register</p>

      <form action="/register" method="post">
        @csrf
        <div class="mt-5 form-input d-flex">
          <i class="fa-solid fa-envelope icon"></i>
          <input type="email" class="form-control input @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autofocus>
        </div>
        <div>
          @error('email')
          <div class="text-danger">
            <small>{{ $message }}</small>
          </div>
          @enderror
        </div>

        <div class="mt-3 form-input">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" class="form-control input @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
        </div>
        <div>
          @error('password')
          <div class="text-danger">
            <small>{{ $message }}</small>
          </div>
          @enderror
        </div>

        <div class="mt-3 form-input">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" class="form-control input @error('confirmPassword') is-invalid @enderror" name="confirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
        </div>
        <div>
          @error('confirmPassword')
          <div class="text-danger">
            <small>{{ $message }}</small>
          </div>
          @enderror
        </div>

        <div class="mt-3 form-input">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" class="form-control input @error('name') is-invalid @enderror" name="name" id="name" placeholder="Username" value="{{ old('name') }}">
        </div>
        <div>
          @error('name')
          <div class="text-danger">
            <small>{{ $message }}</small>
          </div>
          @enderror
        </div>

        <div class="mt-3 form-input">
          <i class="fa-solid fa-address-card icon"></i>
          <input type="number" class="form-control input @error('nip') is-invalid @enderror" name="nip" id="nip" placeholder="NIP" value="{{ old('nip') }}">
        </div>
        <div>
          @error('nip')
          <div class="text-danger">
            <small>{{ $message }}</small>
          </div>
          @enderror
        </div>

        <select class="form-select mt-3 @error('dinas_id') is-invalid @enderror" aria-label="Default select example" name="dinas_id" id="dinas-id">
          <option value="" hidden> Pilih Dinas</option>
          @foreach($dinas as $x)
          <option value="{{$x->id}}" {{ old('dinas_id') == $x->id ? 'selected' : null }}>{{$x->dinas}}</option>
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
          <button class="btn btn-primary rounded-pill fw-bold" type="submit">sign up</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection