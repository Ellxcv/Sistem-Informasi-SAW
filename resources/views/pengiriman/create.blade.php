@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Add New Pengiriman</h2>
        <a class="btn btn-primary" href="{{ route('pengiriman.index') }}"> Back</a>
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

    <form action="{{ route('pengiriman.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Barang:</strong>
                    <input type="text" name="id_barang" class="form-control" placeholder="ID Barang">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Gudang:</strong>
                    <input type="text" name="id_gudang" class="form-control" placeholder="ID Gudang">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Kirim:</strong>
                    <input type="date" name="tanggal_kirim" class="form-control" placeholder="Tanggal Kirim">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah:</strong>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Toko:</strong>
                    <input type="text" name="id_toko" class="form-control" placeholder="ID Toko">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Kendaraan:</strong>
                    <input type="text" name="id_kendaraan" class="form-control" placeholder="ID Kendaraan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Supir:</strong>
                    <input type="text" name="id_supir" class="form-control" placeholder="ID Supir">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
