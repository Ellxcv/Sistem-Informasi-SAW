@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Gudang</h2>
        <a class="btn btn-primary" href="{{ route('gudang.index') }}"> Back</a>
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

    <form action="{{ route('gudang.update', $gudang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Gudang:</strong>
                    <input type="text" name="nama_gudang" value="{{ $gudang->nama_gudang }}" class="form-control" placeholder="Nama Gudang">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi:</strong>
                    <input type="text" name="lokasi" value="{{ $gudang->lokasi }}" class="form-control" placeholder="Lokasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
