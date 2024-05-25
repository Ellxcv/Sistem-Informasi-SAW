@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Toko List</h2>
        <a class="btn btn-success" href="{{ route('toko.create') }}"> Create New Toko</a>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Toko</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 1; @endphp
        @foreach ($tokos as $toko)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $toko->nama_toko }}</td>
            <td>{{ $toko->nomor_telepon }}</td>
            <td>{{ $toko->alamat }}</td>
            <td>
                <form action="{{ route('toko.destroy', $toko->id_toko) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('toko.edit', $toko->id_toko) }}">Edit</a>
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
            <li class="page-item {{ $tokos->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tokos->previousPageUrl() }}">
                    <i class="tf-icon bx bx-chevron-left"></i>
                </a>
            </li>
            <!-- Nomor halaman -->
            @for ($i = 1; $i <= $tokos->lastPage(); $i++)
            <li class="page-item {{ $tokos->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $tokos->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <!-- Tombol Next -->
            <li class="page-item {{ $tokos->currentPage() == $tokos->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tokos->nextPageUrl() }}">
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
@endsection
