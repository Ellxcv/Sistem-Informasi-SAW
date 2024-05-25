@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Barang</h2>
        <a class="btn btn-primary" href="{{ route('barang.index') }}"> Back</a>
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

    <form action="{{ route('barang.update', $barang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang:</strong>
                    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control" placeholder="Nama Barang">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi:</strong>
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi">{{ $barang->deskripsi }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategori:</strong>
                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01" type="text">Options</label>
                        <select class="form-select" id="inputGroupSelect01" name="kategori" placeholder="kategori">
                            <option selected>Choose...</option>
                            <option value="Barang Original" {{ $barang->kategori == 'Barang Original' ? 'selected' : '' }}>Barang Original</option>
                            <option value="Barang Tiruan" {{ $barang->kategori == 'Barang Tiruan' ? 'selected' : '' }}>Barang Tiruan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Berat:</strong>
                    <input type="text" name="berat" value="{{ $barang->berat }}" class="form-control" placeholder="Berat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga:</strong>
                    <input type="text" name="harga" value="{{ $barang->harga }}" class="form-control" placeholder="Harga">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
