@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Normalisasi List</h2>
            <a class="btn btn-success" href="{{ route('normalisasi.create') }}"> Create New Normalisasi</a>
            <!-- Tombol untuk memicu perhitungan normalisasi -->
            <form action="{{ route('hitung-normalisasi') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Hitung Normalisasi</button>
            </form>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <!-- Tabel untuk menampilkan data normalisasi -->
        <table class="table table-bordered">
            <!-- Judul kolom -->
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Kriteria</th>
                <th>Nilai Normalisasi
                    <!-- Tombol untuk pengurutan -->
                    <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nilai_normalisasi')">
                        <span class="tf-icons bx bx-sort"></span>
                    </button>
                </th>
                <th width="280px">Action</th>
            </tr>
            <!-- Data normalisasi -->
            @php $i = 1; @endphp
            @foreach ($normalisasis as $normalisasi)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $normalisasi->alternatif->nama_alternatif }}</td>
                <td>{{ $normalisasi->kriteria->nama_kriteria }}</td>
                <td>{{ $normalisasi->nilai_normalisasi }}</td>
                <td>
                    <!-- Tombol untuk mengedit dan menghapus normalisasi -->
                    <form action="{{ route('normalisasi.destroy', $normalisasi->id_normalisasi) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('normalisasi.edit', $normalisasi->id_normalisasi) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                @php $i++; @endphp
            </tr>
            @endforeach
        </table>
        <!-- Pagination and Dropdown -->
        <div class="d-flex justify-content-center">
            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous button -->
                    <li class="page-item {{ $normalisasis->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $normalisasis->previousPageUrl() }}">
                            <i class="tf-icon bx bx-chevron-left"></i>
                        </a>
                    </li>
                    <!-- Page numbers -->
                    @for ($i = 1; $i <= $normalisasis->lastPage(); $i++)
                    <li class="page-item {{ $normalisasis->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $normalisasis->url($i) }}">{{ $i }}</a>
                    </li>
                    @endfor
                    <!-- Next button -->
                    <li class="page-item {{ $normalisasis->currentPage() == $normalisasis->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $normalisasis->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Dropdown -->
        <div class="btn-group mt-3">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Data
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="changePageSize(2)">2</a></li>
                <li><a class="dropdown-item" href="#" onclick="changePageSize(5)">5</a></li>
                <li><a class="dropdown-item" href="#" onclick="changePageSize(7)">7</a></li>
                <li><a class="dropdown-item" href="#" onclick="changePageSize(10)">10</a></li>
            </ul>
        </div>
    </div>
<script>
    let sortDirection = 'asc'; // Default pengurutan adalah ascending

    // Cek apakah data awal diurutkan secara descending
    @if(request()->has('orderDirection') && request('orderDirection') === 'desc')
        sortDirection = 'desc';
    @endif

    function sortData(column) {
        // Toggle arah pengurutan
        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        // Kirim permintaan ke server untuk pengurrutan
    window.location.href = {{ route('normalisasi.index') }}?orderBy=${column}&orderDirection=${sortDirection};
    }
    function changePageSize(size) {
    window.location.href = "{{ route('normalisasi.index') }}?pageSize=" + size;
    }
    </script>
@endsection

