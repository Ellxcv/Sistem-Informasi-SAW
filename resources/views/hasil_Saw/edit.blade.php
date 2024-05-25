@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Hasil Saw</h2>
        <a class="btn btn-primary" href="{{ route('hasil_saw.index') }}"> Back</a>
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

    <form action="{{ route('hasil_saw.update', $hasilSaw->id_hasil) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alternatif:</strong>
                    <select name="id_alternatif" class="form-control">
                        @foreach($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id_alternatif }}" {{ $hasilSaw->id_alternatif == $alternatif->id_alternatif ? 'selected' : '' }}>{{ $alternatif->nama_alternatif }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nilai Saw:</strong>
                    <input type="text" name="nilai_saw" value="{{ $hasilSaw->nilai_saw }}" class="form-control" placeholder="Nilai Saw">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
