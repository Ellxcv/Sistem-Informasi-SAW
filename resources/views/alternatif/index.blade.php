@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Alternatif List</h2>
        <a class="btn btn-success" href="{{ route('alternatif.create') }}"> Create New Alternatif</a>
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
                <caption class="ms-4">List of Alternatif</caption>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th>Deskripsi</th>
                        <th>Barang</th>
                        <th>Nilai Harga
                            <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nilai_harga')">
                                <span class="tf-icons bx bx-sort"></span>
                            </button>
                        </th>
                        <th>Nilai Kualitas
                            <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nilai_kualitas')">
                                <span class="tf-icons bx bx-sort"></span>
                            </button>
                        </th>
                        <th>Nilai Pelayanan
                            <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nilai_pelayanan')">
                                <span class="tf-icons bx bx-sort"></span>
                            </button>
                        </th>
                        <th>Nilai Lokasi
                            <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('nilai_lokasi')">
                                <span class="tf-icons bx bx-sort"></span>
                            </button>
                        </th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($alternatifs->currentPage() - 1) * $alternatifs->perPage() + 1; @endphp
                    @foreach ($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        <td>{{ $alternatif->deskripsi }}</td>
                        <td>{{ $alternatif->barang->nama_barang }}</td>
                        <td>{{ $alternatif->nilai_harga }}</td>
                        <td>{{ $alternatif->nilai_kualitas }}</td>
                        <td>{{ $alternatif->nilai_pelayanan }}</td>
                        <td>{{ $alternatif->nilai_lokasi }}</td>
                        <td>
                            <form action="{{ route('alternatif.destroy', $alternatif->id_alternatif) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('alternatif.edit', $alternatif) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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
            <ul class="pagination">
                <!-- Tombol Previous -->
                <li class="page-item {{ $alternatifs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $alternatifs->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <!-- Nomor halaman -->
                @for ($i = 1; $i <= $alternatifs->lastPage(); $i++)
                <li class="page-item {{ $alternatifs->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $alternatifs->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Tombol Next -->
                <li class="page-item {{ $alternatifs->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $alternatifs->nextPageUrl() }}">
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
    function sortData(column) {
        // Dapatkan arah pengurutan saat ini
        let orderDirection = 'asc';
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        if (params.get('orderBy') === column && params.get('orderDirection') === 'asc') {
            orderDirection = 'desc';
        }
        window.location.href = `{{ route('alternatif.index') }}?orderBy=${column}&orderDirection=${orderDirection}&pageSize={{ request()->input('pageSize', 10) }}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('alternatif.index') }}?pageSize=" + size + "&orderBy={{ request()->input('orderBy', 'id_alternatif') }}&orderDirection={{ request()->input('orderDirection', 'asc') }}";
    }
</script>
@endsection
