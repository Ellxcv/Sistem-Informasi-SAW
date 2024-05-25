@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tambah Kendaraan Baru</h2>
        <a class="btn btn-primary" href="{{ route('kendaraan.index') }}">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada masalah dengan input Anda. Silakan cek kembali.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_kendaraan">Nama Kendaraan:</label>
                    <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" placeholder="Nama Kendaraan" value="{{ old('nama_kendaraan') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nomor_plat">Nomor Plat:</label>
                    <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" placeholder="Nomor Plat" value="{{ old('nomor_plat') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kapasitas">Kapasitas:</label>
                    <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Kapasitas" value="{{ old('kapasitas') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
