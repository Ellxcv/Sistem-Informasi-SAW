@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Hasil Metode SAW</h2>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>

<!-- Tabel Analisa -->
    <div class="card mb-3">
        <h5 class="card-header">Tahap Analisa</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered">
                <caption class="ms-4">List of Analisa</caption>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($analisa as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item['nama_alternatif'] }}</td>
                            @foreach ($item['nilai'] as $nilai)
                                <td>{{ $nilai }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($kriterias) + 2 }}">No Data Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    

<!-- Tabel Normalisasi -->
<div class="card mb-3">
    <h5 class="card-header">Tahap Normalisasi</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover table-bordered">
            <caption class="ms-4">List of Normalisasi Results</caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($normalisasi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nama_alternatif'] }}</td>
                        @foreach ($item['nilai'] as $nilai)
                            <td>{{ $nilai }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($kriterias) + 2 }}">No Data Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    
    <!-- Tabel Hasil SAW -->
    <div class="card mb-3">
        <h5 class="card-header">Hasil SAW</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered">
                <caption class="ms-4">List of SAW Results</caption>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai SAW</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perangkingan as $key => $result)
                        <tr>
                            <td>{{ intval($key) + 1 }}</td>
                            <td>{{ $result->alternatif->nama_alternatif ?? 'Unknown' }}</td>
                            <td>{{ $result->nilai_saw }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No Data Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
