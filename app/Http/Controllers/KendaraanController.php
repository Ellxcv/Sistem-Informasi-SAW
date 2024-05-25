<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'nama_kendaraan');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10);

        $kendaraans = Kendaraan::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
            'nomor_plat' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        Kendaraan::create($request->all());
        
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan created successfully.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
            'nomor_plat' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan updated successfully.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan deleted successfully.');
    }
}

