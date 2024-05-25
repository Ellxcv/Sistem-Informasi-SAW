@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Pegawai</h2>
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

    <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Pegawai:</strong>
                    <input type="text" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" class="form-control" placeholder="Nama Pegawai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jabatan:</strong>
                    <input type="text" name="jabatan" value="{{ $pegawai->jabatan }}" class="form-control" placeholder="Jabatan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Telepon:</strong>
                    <input type="text" name="nomor_telepon" value="{{ $pegawai->nomor_telepon }}" class="form-control" placeholder="Nomor Telepon">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Toko:</strong>
                    <select class="form-select" name="id_toko">
                        @foreach ($tokos as $toko)
                            <option value="{{ $toko->id_toko }}" {{ $pegawai->id_toko == $toko->id_toko ? 'selected' : '' }}>{{ $toko->nama_toko }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
