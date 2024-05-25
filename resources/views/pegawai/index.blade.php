<!-- resources/views/pegawai/index.blade.php -->
@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Pegawai List</h2>
        <a class="btn btn-success" href="{{ route('pegawai.create') }}"> Create New Pegawai</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Nomor Telepon</th>
            <th>Toko</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($pegawai as $peg)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $peg->nama_pegawai }}</td>
            <td>{{ $peg->jabatan }}</td>
            <td>{{ $peg->nomor_telepon }}</td>
            <td>{{ $peg->toko->nama_toko }}</td>
            <td>
                <form action="{{ route('pegawai.destroy', $peg->id_pegawai) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('pegawai.edit', $peg->id_pegawai) }}">Edit</a>
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
                <li class="page-item {{ $pegawai->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $pegawai->previousPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>       
                <!-- Nomor halaman -->
                @for ($i = 1; $i <= $pegawai->lastPage(); $i++)
                <li class="page-item {{ $pegawai->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $pegawai->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <!-- Tombol Next -->
                <li class="page-item {{ $pegawai->currentPage() == $pegawai->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $pegawai->nextPageUrl() }}">
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
        window.location.href = `{{ route('pegawai.index') }}?orderBy=${column}&orderDirection=${sortDirection}`;
    }

    function changePageSize(size) {
        window.location.href = "{{ route('pegawai.index') }}?pageSize=" + size;
    }
</script>
@endsection
