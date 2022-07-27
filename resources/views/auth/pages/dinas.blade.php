@extends('auth.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Dinas</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
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
                <td><button type="button" class="badge bg-primary border-0 mx-auto">edit</button>
                <button type="button" class="badge bg-danger border-0">delete</button></td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
@endsection