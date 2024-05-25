@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Pengiriman List</h2>
        <a class="btn btn-success" href="{{ route('pengiriman.create') }}"> Create New Pengiriman</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>ID Barang</th>
            <th>ID Gudang</th>
            <th>Tanggal Kirim</th>
            <th>Jumlah
                <button type="button" class="btn btn-icon btn-outline-secondary" onclick="sortData('jumlah')">
                    <span class="tf-icons bx bx-sort"></span>
                </button>
            </th>
            <th>ID Toko</th>
            <th>ID Kendaraan</th>
            <th>ID Supir</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($pengirimans as $pengiriman)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $pengiriman->id_barang }}</td>
            <td>{{ $pengiriman->id_gudang }}</td>
            <td>{{ $pengiriman->tanggal_kirim }}</td>
            <td>{{ $pengiriman->jumlah }}</td>
            <td>{{ $pengiriman->id_toko }}</td>
            <td>{{ $pengiriman->id_kendaraan }}</td>
            <td>{{ $pengiriman->id_supir }}</td>
            <td>
                <form action="{{ route('pengiriman.destroy', $pengiriman->id_pengiriman) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('pengiriman.edit', $pengiriman->id_pengiriman) }}">Edit</a>
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
                <li class="page-item {{ $pengirimans->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $pengirimans->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <!-- Nomor halaman -->
                @for ($i = 1; $i <= $pengirimans->lastPage(); $i++)
                <li class="page-item {{ $pengirimans->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $pengirimans->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Tombol Next -->
                <li class="page-item {{ $pengirimans->currentPage() == $pengirimans->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $pengirimans->nextPageUrl() }}">
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
        window.location.href = `{{ route('pengiriman.index') }}?orderBy=${column}&orderDirection=${sortDirection}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('pengiriman.index') }}?pageSize=" + size;
    }
</script>
@endsection
