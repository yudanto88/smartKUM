@extends('auth.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header fw-bold" style="background-color: #748DA6;">
                        <i class="fa-solid fa-user me-2"></i> 
                        User
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #9CB4CC;">
                        <h5 class="card-title">Jumlah User</h5>
                        <p class="card-text">{{$users->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header fw-bold" style="background-color: #6FEDD6;">
                        <i class="fa-solid fa-building-user me-2"></i>
                        Dinas
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #B9FFF8;">
                        <h5 class="card-title">Jumlah Dinas</h5>
                        <p class="card-text">{{$dinas->skip(1)->count()}}</p>
                    </div>
                </div>
            </div>           
            <div class="col-4">
                <div class="card">
                    <div class="card-header fw-bold" style="background-color: #D8CCA3;">
                        <i class="fa-solid fa-file me-2"></i>
                        Jenis
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #EDDFB3;">
                        <h5 class="card-title">Jumlah Jenis / Bentuk Peraturan</h5>
                        <p class="card-text">{{$jenis->count()}}</p>
                    </div>
                </div>
            </div> 
            <div class="col-4">
                <div class="card">
                    <div class="card-header fw-bold" style="background-color: #F0E161;">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #FFF38C;">
                        <h5 class="card-title">Jumlah Draft yang diajukan</h5>
                        <p class="card-text">{{$draft->where('status', 'menunggu')->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header fw-bold" style="background-color: #C21010;">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #E64848;">
                        <h5 class="card-title">Jumlah Draft yang ditolak</h5>
                        <p class="card-text">{{$draft->where('status', 'ditolak')->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header fw-bold" style="background-color: #5BB318;">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #7DCE13;">
                        <h5 class="card-title">Jumlah Draft yang diterima</h5>
                        <p class="card-text">{{$draft->where('status', 'diterima')->count()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection