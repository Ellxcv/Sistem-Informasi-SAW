<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
@include('partials.header')
</head>

  <body>

  @include('partials.konten')

          <!-- / Navbar -->

          <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="{{ route('barang.index') }}" class="btn btn-primary w-100 mb-3">Barang</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('gudang.index') }}" class="btn btn-primary w-100 mb-3">Gudang</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('toko.index') }}" class="btn btn-primary w-100 mb-3">Toko</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('kendaraan.index') }}" class="btn btn-primary w-100 mb-3">Kendaraan</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="{{ route('supir.index') }}" class="btn btn-primary w-100 mb-3">Supir</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('pegawai.index') }}" class="btn btn-primary w-100 mb-3">Pegawai</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('kriteria.index') }}" class="btn btn-primary w-100 mb-3">Kriteria</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('rating_kriteria.index') }}" class="btn btn-primary w-100 mb-3">Rating Kriteria</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="{{ route('pengiriman.index') }}" class="btn btn-primary w-100 mb-3">Pengiriman</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('jadwal_kirim.index') }}" class="btn btn-primary w-100 mb-3">Jadwal Kirim</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('normalisasi.index') }}" class="btn btn-primary w-100 mb-3">Normalisasi</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('hasil_saw.index') }}" class="btn btn-primary w-100 mb-3">Hasil SAW</a>
            </div>
        </div>
    </div>



          @include('partials.footer')
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('vendor/js/menu.js')}}"></script>
    <script src="{{asset('vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/dashboards-analytics.js')}}"></script>
  </body>
</html>
