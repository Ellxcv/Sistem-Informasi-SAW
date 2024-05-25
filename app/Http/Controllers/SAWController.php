<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\RatingKriteria;
use App\Models\Normalisasi;
use App\Models\SawResult;
use Illuminate\Support\Facades\DB;

class SawController extends Controller
{
    public function index()
    {
        // Retrieve data from the models
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $ratings = RatingKriteria::all();
        $normalisasis = Normalisasi::all();
    
        // Check if data is retrieved correctly
        if ($alternatifs->isEmpty() || $kriterias->isEmpty() || $ratings->isEmpty() || $normalisasis->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau kosong.');
        }
    
        // Process data and calculate SAW results
        $analisa = $this->processAnalisa($alternatifs, $kriterias, $ratings);
        $normalisasi = $this->processNormalisasi($alternatifs, $normalisasis, $kriterias);
        $sawResults = $this->calculateSawResults($alternatifs, $kriterias, $normalisasis);
        $perangkingan = $this->getRankedData();
        
        // Return view with data
        return view('saw_results', compact('kriterias', 'analisa', 'normalisasi', 'perangkingan'));
    }    

    private function processAnalisa($alternatifs, $kriterias, $ratings)
    {
        return $alternatifs->map(function ($alternatif) use ($ratings, $kriterias) {
            return [
                'nama_alternatif' => $alternatif->nama_alternatif,
                'nilai' => $kriterias->map(function ($kriteria) use ($ratings, $alternatif) {
                    $rating = $ratings->where('id_alternatif', $alternatif->id_alternatif)
                                      ->where('id_kriteria', $kriteria->id_kriteria)
                                      ->first();
                    return $rating ? (float)$rating->nilai : 0.0;
                })->toArray()
            ];
        });
    }

    private function processNormalisasi($alternatifs, $normalisasis, $kriterias)
    {
        return $alternatifs->map(function ($alternatif) use ($normalisasis, $kriterias) {
            return [
                'nama_alternatif' => $alternatif->nama_alternatif,
                'nilai' => $kriterias->map(function ($kriteria) use ($normalisasis, $alternatif) {
                    $normalisasi = $normalisasis->where('id_alternatif', $alternatif->id_alternatif)
                                                ->where('id_kriteria', $kriteria->id_kriteria)
                                                ->first();
                    return $normalisasi ? (float)$normalisasi->nilai_normalisasi : 0.0;
                })->toArray()
            ];
        });
    }

    private function calculateSawResults($alternatifs, $kriterias, $normalisasis)
    {
        $sawResults = [];

        foreach ($alternatifs as $alternatif) {
            $nilaiSaw = 0.0;
            foreach ($kriterias as $kriteria) {
                $normalisasi = $normalisasis->where('id_alternatif', $alternatif->id_alternatif)
                                            ->where('id_kriteria', $kriteria->id_kriteria)
                                            ->first();
                if ($normalisasi) {
                    $bobot = $kriteria->bobot;
                    if (is_numeric($bobot) && is_numeric($normalisasi->nilai_normalisasi)) {
                        $nilaiSaw += floatval($normalisasi->nilai_normalisasi) * floatval($bobot);
                    }
                }
            }
            $sawResults[] = [
                'id_alternatif' => $alternatif->id_alternatif,
                'nilai_saw' => $nilaiSaw
            ];
        }

        // Sort SAW results
        usort($sawResults, function ($a, $b) {
            return $b['nilai_saw'] <=> $a['nilai_saw'];
        });

        // Store SAW results in the database
        DB::beginTransaction();
        try {
            SawResult::truncate();
            foreach ($sawResults as $result) {
                SawResult::create($result);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan hasil perhitungan SAW.');
        }

        return $sawResults;
    }

    private function getRankedData()
    {
        return SawResult::with('alternatif')->get();
    }
}
