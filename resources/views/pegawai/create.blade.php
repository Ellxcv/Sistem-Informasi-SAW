@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Add New Pegawai</h2>
        <a class="btn btn-primary" href="{{ route('pegawai.index') }}"> Back</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Pegawai:</strong>
                    <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jabatan:</strong>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Telepon:</strong>
                    <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Toko:</strong>
                    <select class="form-select" name="id_toko">
                        <option selected>Choose...</option>
                        @foreach ($tokos as $toko)
                            <option value="{{ $toko->id_toko }}">{{ $toko->nama_toko }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
