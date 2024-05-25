@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gudang List</h2>
        <a class="btn btn-success" href="{{ route('gudang.create') }}">Create New Gudang</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>
                No
            </th>
            <th>
            Nama Gudang
                <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nama_gudang')">
                    <span class="tf-icons bx bx-sort"></span>
                </button>
            </th>
            <th>
                Lokasi
            </th>
            <th width="280px">
                Action
            </th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($gudangs as $gudang)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $gudang->nama_gudang }}</td>
            <td>{{ $gudang->lokasi }}</td>
            <td>
                <form action="{{ route('gudang.destroy',$gudang->id_gudang) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('gudang.edit', $gudang) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            @php $i++; @endphp
        </tr>
        @endforeach
    </table>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Tombol Previous -->
            <li class="page-item {{ $gudangs->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $gudangs->previousPageUrl() }}">
                    <i class="tf-icon bx bx-chevron-left"></i>
                </a>
            </li>
            <!-- Nomor halaman -->
            @for ($i = 1; $i <= $gudangs->lastPage(); $i++)
            <li class="page-item {{ $gudangs->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $gudangs->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <!-- Tombol Next -->
            <li class="page-item {{ $gudangs->currentPage() == $gudangs->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $gudangs->nextPageUrl() }}">
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

    <!-- Dropdown untuk Jumlah Data -->
    <div class="btn-group mt-3">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Data per Halaman
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="changePageSize(5)">5</a></li>
            <li><a class="dropdown-item" href="#" onclick="changePageSize(10)">10</a></li>
            <li><a class="dropdown-item" href="#" onclick="changePageSize(20)">20</a></li>
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
        window.location.href = `{{ route('gudang.index') }}?orderBy=${column}&orderDirection=${sortDirection}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('gudang.index') }}?pageSize=" + size;
    }
</script>

@endsection
