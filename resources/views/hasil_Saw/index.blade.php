@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Hasil Saw List</h2>
        <div>
            <a class="btn btn-success" href="{{ route('hasil.create') }}"> Create New Hasil Saw</a>
            <!-- Tambahkan tombol Print di sini -->
            <button type="button" class="btn btn-outline-secondary" onclick="printHasil()">
                <span class="tf-icons bx bx-print"></span>&nbsp; Print
            </button>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Alternatif</th>
            <th>Nilai Saw</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($hasilSaws as $hasilSaw)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $hasilSaw->alternatif->nama_alternatif }}</td>
            <td>{{ $hasilSaw->nilai_saw }}</td>
            <td>
                <form action="{{ route('hasil.destroy', $hasilSaw->id_hasil) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('hasil.edit', $hasilSaw->id_hasil) }}">Edit</a>
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
                <li class="page-item {{ $hasilSaws->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hasilSaws->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <!-- Page numbers -->
                @for ($i = 1; $i <= $hasilSaws->lastPage(); $i++)
                <li class="page-item {{ $hasilSaws->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $hasilSaws->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Next button -->
                <li class="page-item {{ $hasilSaws->currentPage() == $hasilSaws->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hasilSaws->nextPageUrl() }}">
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
        // Kirim permintaan ke server untuk pengurutan
        window.location.href = `{{ route('hasil.index') }}?orderBy=${column}&orderDirection=${sortDirection}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('hasil.index') }}?pageSize=" + size;
    }

    // Fungsi untuk menangani pencetakan hasil
    function printHasil() {
        window.open("{{ route('hasil.print') }}", '_blank');
    }
</script>
@endsection
