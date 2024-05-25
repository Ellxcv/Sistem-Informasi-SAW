<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB; // tambahkan penggunaan DB untuk kueri

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'nama_barang');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data barang dengan pengurutan dan pembagian halaman
        $barangs = Barang::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('barang.index', compact('barangs'));
    }
    
    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
{
    return view('barang.edit', compact('barang'));
}


    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang updated successfully.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }

}
