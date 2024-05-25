@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Normalisasi</h2>
        <a class="btn btn-primary" href="{{ route('normalisasi.index') }}"> Back</a>
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

    <form action="{{ route('normalisasi.update', $normalisasi->id_normalisasi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alternatif:</strong>
                    <!-- normalisasi/index.blade.php -->

                    <select name="id_alternatif" class="form-control">
                        @foreach($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->nama_alternatif }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kriteria:</strong>
                    <select name="id_kriteria" class="form-control">
                        @foreach($kriterias as $kriteria)
                        <option value="{{ $kriteria->id_kriteria }}" {{ $normalisasi->id_kriteria == $kriteria->id_kriteria ? 'selected' : '' }}>{{ $kriteria->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Normalisasi:</strong>
                    <input type="text" name="nilai_normalisasi" value="{{ $normalisasi->nilai_normalisasi }}" class="form-control" placeholder="Nilai Normalisasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
