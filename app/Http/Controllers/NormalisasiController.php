<?php

namespace App\Http\Controllers;

use App\Models\Normalisasi;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\RatingKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NormalisasiController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_normalisasi');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data normalisasi dengan pengurutan dan pembagian halaman
        $normalisasis = Normalisasi::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        // Mengambil data alternatif untuk dropdown
        $alternatifs = Alternatif::all();

        // Mengambil data kriteria untuk dropdown
        $kriterias = Kriteria::all();

        return view('normalisasi.index', compact('normalisasis', 'alternatifs', 'kriterias'));
    }

    // Fungsi untuk menampilkan form tambah data normalisasi
    public function create()
    {
        return view('normalisasi.create');
    }

    // Fungsi untuk menyimpan data normalisasi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'id_kriteria' => 'required',
            'nilai_normalisasi' => 'required'
        ]);

        Normalisasi::create($request->all());
        return redirect()->route('normalisasi.index')->with('success', 'Normalisasi created successfully.');
    }

    // Fungsi untuk menampilkan detail normalisasi
    public function show(Normalisasi $normalisasi)
    {
        return view('normalisasi.show', compact('normalisasi'));
    }

    // Fungsi untuk menampilkan form edit data normalisasi
    public function edit(Normalisasi $normalisasi)
    {
        // Mengambil data alternatif untuk dropdown
        $alternatifs = Alternatif::all();
    
        // Mengambil data kriteria untuk dropdown
        $kriterias = Kriteria::all();
    
        // Melakukan pengecekan apakah data normalisasi ditemukan
        if (!$normalisasi) {
            // Tindakan jika data normalisasi tidak ditemukan
            return redirect()->route('normalisasi.index')->with('error', 'Data not found.');
        }
    
        // Menampilkan view edit normalisasi beserta data yang diperlukan
        return view('normalisasi.edit', compact('normalisasi', 'alternatifs', 'kriterias'));
    }

    // Fungsi untuk menyimpan perubahan data normalisasi yang telah diedit
    public function update(Request $request, Normalisasi $normalisasi)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'id_kriteria' => 'required',
            'nilai_normalisasi' => 'required'
        ]);

        try {
            $normalisasi->update($request->all());
            return redirect()->route('normalisasi.index')->with('success', 'Normalisasi updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('normalisasi.index')->with('error', 'Failed to update normalisation data.');
        }
    }

    // Fungsi untuk menghapus data normalisasi
    public function destroy(Normalisasi $normalisasi)
    {
        try {
            $normalisasi->delete();
            return redirect()->route('normalisasi.index')->with('success', 'Normalisasi deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('normalisasi.index')->with('error', 'Failed to delete normalisation data.');
        }
    }

    public function hitungNormalisasi()
    {
        // Ambil semua alternatif
        $alternatifs = Alternatif::all();
        
        // Ambil semua kriteria
        $kriterias = Kriteria::all();
    
        // Mulai transaksi database
        DB::beginTransaction();
    
        try {
            // Hitung dan simpan normalisasi
            foreach ($kriterias as $kriteria) {
                // Ambil nilai maksimum dan minimum untuk kriteria saat ini
                $maxValue = $kriteria->max;
                $minValue = $kriteria->min;
    
                foreach ($alternatifs as $alternatif) {
                    // Ambil rating kriteria untuk alternatif saat ini
                    $ratingKriteria = RatingKriteria::where('id_alternatif', $alternatif->id_alternatif)
                                                     ->where('id_kriteria', $kriteria->id_kriteria)
                                                     ->first();
    
                    if ($ratingKriteria && ($maxValue - $minValue) != 0) {
                        // Hitung nilai normalisasi
                        $nilaiNormalisasi = ($ratingKriteria->nilai - $minValue) / ($maxValue - $minValue);
                        $nilaiNormalisasi = max(0, $nilaiNormalisasi);
                    } else {
                        $nilaiNormalisasi = 0;
                    }
    
                    // Simpan nilai normalisasi ke database
                    $normalisasi = new Normalisasi();
                    $normalisasi->id_alternatif = $alternatif->id_alternatif;
                    $normalisasi->id_kriteria = $kriteria->id_kriteria;
                    $normalisasi->nilai_normalisasi = $nilaiNormalisasi;
                    $normalisasi->save();
                }
            }
    
            // Perbarui data alternatif
            foreach ($alternatifs as $alternatif) {
                // Hitung total nilai normalisasi untuk setiap alternatif
                $totalNormalisasi = $alternatif->normalisasis()->sum('nilai_normalisasi');
                // Perbarui nilai total normalisasi pada model Alternatif
                $alternatif->update(['total_normalisasi' => $totalNormalisasi]);
            }
    
            // Commit transaksi database
            DB::commit();
    
            return redirect()->route('normalisasi.index')->with('success', 'Normalisasi calculated and data updated successfully.');
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('normalisasi.index')->with('error', 'Failed to calculate normalisation and update data.');
        }
    }
    
}
                                
