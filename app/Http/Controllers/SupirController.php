<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'nama_supir');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data supir dengan pengurutan dan pembagian halaman
        $supirs = Supir::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('supir.index', compact('supirs'));
    }

    public function create()
    {
        return view('supir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supir' => 'required',
            'nomor_telepon' => 'required|numeric'
        ]);

        Supir::create($request->all());
        return redirect()->route('supir.index')->with('success', 'Supir created successfully.');
    }

    public function show(Supir $supir)
    {
        return view('supir.show', compact('supir'));
    }

    public function edit(Supir $supir)
    {
        return view('supir.edit', compact('supir'));
    }

    public function update(Request $request, Supir $supir)
    {
        $request->validate([
            'nama_supir' => 'required',
            'nomor_telepon' => 'required|numeric'
        ]);

        $supir->update($request->all());
        return redirect()->route('supir.index')->with('success', 'Supir updated successfully.');
    }

    public function destroy(Supir $supir)
    {
        $supir->delete();
        return redirect()->route('supir.index')->with('success', 'Supir deleted successfully.');
    }
}
