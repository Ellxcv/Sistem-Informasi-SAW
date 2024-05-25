@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Rating Kriteria</h2>
        <a class="btn btn-primary" href="{{ route('rating_kriteria.index') }}"> Back</a>
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

    <form action="{{ route('rating_kriteria.update', $ratingKriteria->id_rating) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alternatif:</strong>
                    <select class="form-select" name="id_alternatif">
                        @foreach($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id_alternatif }}" {{ $ratingKriteria->id_alternatif == $alternatif->id_alternatif ? 'selected' : '' }}>{{ $alternatif->nama_alternatif }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kriteria:</strong>
                    <select class="form-select" name="id_kriteria">
                        @foreach($kriterias as $kriteria)
                            <option value="{{ $kriteria->id_kriteria }}" {{ $ratingKriteria->id_kriteria == $kriteria->id_kriteria ? 'selected' : '' }}>{{ $kriteria->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai:</strong>
                    <input type="text" name="nilai" value="{{ $ratingKriteria->nilai }}" class="form-control" placeholder="Nilai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
