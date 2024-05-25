@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Kriteria List</h2>
        <a class="btn btn-success" href="{{ route('kriteria.create') }}">Create New Kriteria</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card">
        <h5 class="card-header">Table Caption</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered">
                <caption class="ms-4">List of Kriteria</caption>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Deskripsi</th>
                        <th>Bobot
                            <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('bobot')">
                                <span class="tf-icons bx bx-sort"></span>
                            </button>
                        </th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($kriterias->currentPage() - 1) * $kriterias->perPage() + 1; @endphp
                    @foreach ($kriterias as $kriteria)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $kriteria->nama_kriteria }}</td>
                        <td>{{ $kriteria->deskripsi }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>
                            <form action="{{ route('kriteria.destroy', $kriteria->id_kriteria) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('kriteria.edit', $kriteria->id_kriteria) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination dan Dropdown -->
    <div class="d-flex justify-content-center mt-3">
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <!-- Tombol Previous -->
                <li class="page-item prev {{ $kriterias->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $kriterias->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <!-- Nomor halaman -->
                @for ($i = 1; $i <= $kriterias->lastPage(); $i++)
                <li class="page-item {{ $kriterias->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $kriterias->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Tombol Next -->
                <li class="page-item next {{ $kriterias->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $kriterias->nextPageUrl() }}">
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
    let sortDirection = '{{ request()->input('orderDirection', 'asc') }}';

    function sortData(column) {
        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        window.location.href = `{{ route('kriteria.index') }}?orderBy=${column}&orderDirection=${sortDirection}&pageSize={{ request()->input('pageSize', 10) }}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('kriteria.index') }}?pageSize=" + size + "&orderBy={{ request()->input('orderBy', 'id_kriteria') }}&orderDirection={{ request()->input('orderDirection', 'asc') }}";
    }
</script>
@endsection
