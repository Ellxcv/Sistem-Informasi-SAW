<?php

namespace App\Http\Controllers;

use App\Models\RatingKriteria;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class RatingKriteriaController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_rating');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data rating kriteria dengan pengurutan dan pembagian halaman
        $ratingKriterias = RatingKriteria::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('rating_kriteria.index', compact('ratingKriterias'));
    }

    public function create()
    {
        // Logika untuk menampilkan form tambah rating kriteria
        return view('rating_kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'id_kriteria' => 'required',
            'nilai' => 'required',
        ]);

        // Ambil nilai alternatif berdasarkan ID yang diterima dari request
        $alternatif = Alternatif::findOrFail($request->id_alternatif);

        // Ambil nilai kriteria berdasarkan ID yang diterima dari request
        $kriteria = Kriteria::findOrFail($request->id_kriteria);

        // Simpan nilai dari model Alternatif ke dalam model RatingKriteria
        RatingKriteria::create([
            'id_alternatif' => $request->id_alternatif,
            'id_kriteria' => $request->id_kriteria,
            'nilai' => $alternatif->getAttributeValue('nilai_' . strtolower($kriteria->nama_kriteria)), // Ambil nilai dari kolom yang sesuai dengan nama kriteria
        ]);

        return redirect()->route('rating_kriteria.index')
            ->with('success', 'Rating kriteria created successfully.');
    }

    public function show(RatingKriteria $rating)
    {
        return view('rating_kriteria.show', compact('rating'));
    }

    public function edit(RatingKriteria $rating)
    {
        return view('rating_kriteria.edit', compact('rating'));
    }

    public function update(Request $request, RatingKriteria $rating)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'id_kriteria' => 'required',
            'nilai' => 'required',
        ]);

        $rating->update($request->all());
        return redirect()->route('rating_kriteria.index')
            ->with('success', 'Rating kriteria updated successfully.');
    }

    public function destroy(RatingKriteria $rating)
    {
        $rating->delete();
        return redirect()->route('rating_kriteria.index')
            ->with('success', 'Rating kriteria deleted successfully.');
    }
}