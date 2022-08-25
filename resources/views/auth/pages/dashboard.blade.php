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
                    <div class="card-header">
                        <i class="fa-solid fa-user me-2"></i> 
                        User
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah User</h5>
                        <p class="card-text">{{$users->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-building-user me-2"></i>
                        Dinas
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Dinas</h5>
                        <p class="card-text">{{$dinas->skip(1)->count()}}</p>
                    </div>
                </div>
            </div>           
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-file me-2"></i>
                        Jenis
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Jenis / Bentuk Peraturan</h5>
                        <p class="card-text">{{$jenis->count()}}</p>
                    </div>
                </div>
            </div> 
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Draft yang diajukan</h5>
                        <p class="card-text">{{$draft->where('status', 'menunggu')->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Draft yang ditolak</h5>
                        <p class="card-text">{{$draft->where('status', 'ditolak')->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-file me-2"></i>
                        Draft
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Draft yang diterima</h5>
                        <p class="card-text">{{$draft->where('status', 'diterima')->count()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection