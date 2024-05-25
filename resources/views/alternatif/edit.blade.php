@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Alternatif</h2>
        <a class="btn btn-primary" href="{{ route('alternatif.index') }}"> Back</a>
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

    <form action="{{ route('alternatif.update', $alternatif->id_alternatif) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Alternatif:</strong>
                    <input type="text" name="nama_alternatif" value="{{ $alternatif->nama_alternatif }}" class="form-control" placeholder="Nama Alternatif">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi:</strong>
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi">{{ $alternatif->deskripsi }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Barang:</strong>
                    <select name="id_barang" class="form-control">
                        @foreach($barangs as $barang)
                        <option value="{{ $barang->id_barang }}" {{ $barang->id_barang === $alternatif->id_barang ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Harga:</strong>
                    <input type="text" name="nilai_harga" value="{{ $alternatif->nilai_harga }}" class="form-control" placeholder="Nilai Harga">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Kualitas:</strong>
                    <input type="text" name="nilai_kualitas" value="{{ $alternatif->nilai_kualitas }}" class="form-control" placeholder="Nilai Kualitas">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Pelayanan:</strong>
                    <input type="text" name="nilai_pelayanan" value="{{ $alternatif->nilai_pelayanan }}" class="form-control" placeholder="Nilai Pelayanan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Lokasi:</strong>
                    <input type="text" name="nilai_lokasi" value="{{ $alternatif->nilai_lokasi }}" class="form-control" placeholder="Nilai Lokasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
