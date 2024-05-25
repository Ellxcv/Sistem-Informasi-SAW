<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Barang;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_alternatif');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10);

        // Mengambil data alternatif dengan pagination dan sorting
        $alternatifs = Alternatif::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        // Menambahkan query string pada pagination links
        $alternatifs->appends($request->all());

        // Mengirimkan data ke view
        return view('alternatif.index', compact('alternatifs', 'orderBy', 'orderDirection', 'pageSize'));
    }
    
    public function create()
    {
        $barangs = Barang::all();
        return view('alternatif.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            'deskripsi' => 'required',
            'id_barang' => 'required',
            'nilai_harga' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_kualitas' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_pelayanan' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_lokasi' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
        ]);

        Alternatif::create($request->all());
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function show(Alternatif $alternatif)
    {
        return view('alternatif.show', compact('alternatif'));
    }

    public function edit(Alternatif $alternatif)
    {
        $barangs = Barang::all();
        return view('alternatif.edit', compact('alternatif', 'barangs'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            'deskripsi' => 'required',
            'id_barang' => 'required',
            'nilai_harga' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_kualitas' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_pelayanan' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
            'nilai_lokasi' => 'required|numeric', // Sesuaikan dengan kolom baru yang ditambahkan
        ]);

        $alternatif->update($request->all());
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus.');
    }
}
