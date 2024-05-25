@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Kendaraan</h2>
        <a class="btn btn-primary" href="{{ route('kendaraan.index') }}"> Back</a>
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

    <form action="{{ route('kendaraan.update', $kendaraan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Kendaraan:</strong>
                    <input type="text" name="nama_kendaraan" value="{{ $kendaraan->nama_kendaraan }}" class="form-control" placeholder="Nama Kendaraan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Plat:</strong>
                    <input type="text" name="nomor_plat" value="{{ $kendaraan->nomor_plat }}" class="form-control" placeholder="Nomor Plat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kapasitas:</strong>
                    <input type="text" name="kapasitas" value="{{ $kendaraan->kapasitas }}" class="form-control" placeholder="Kapasitas">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
