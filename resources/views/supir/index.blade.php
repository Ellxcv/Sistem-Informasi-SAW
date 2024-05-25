<!-- resources/views/supir/index.blade.php -->
@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Supir List</h2>
        <a class="btn btn-success" href="{{ route('supir.create') }}">Create New Supir</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>
                Nama Supir
                <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nama_supir')">
                    <span class="tf-icons bx bx-sort"></span>
                </button>
            </th>
            <th>Nomor Telepon</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($supirs as $supir)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $supir->nama_supir }}</td>
            <td>{{ $supir->nomor_telepon }}</td>
            <td>
                <form action="{{ route('supir.destroy', $supir->id_supir) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('supir.edit', $supir) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            @php $i++; @endphp
        </tr>
        @endforeach
    </table>

    <!-- Pagination dan Dropdown -->
    <div class="d-flex justify-content-center"> 
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Tombol Previous -->
                <li class="page-item {{ $supirs->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $supirs->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>       
                <!-- Nomor halaman -->
                @for ($i = 1; $i <= $supirs->lastPage(); $i++)
                <li class="page-item {{ $supirs->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $supirs->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Tombol Next -->
                <li class="page-item {{ $supirs->currentPage() == $supirs->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $supirs->nextPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Dropdown -->
    <div class="btn-group">
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
        window.location.href = `{{ route('supir.index') }}?orderBy=${column}&orderDirection=${sortDirection}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('supir.index') }}?pageSize=" + size;
    }
</script>
@endsection
