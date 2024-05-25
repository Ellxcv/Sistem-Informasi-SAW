<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::paginate(10);
        return view('toko.index', compact('tokos'));
    }

    public function create()
    {
        return view('toko.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required'
        ]);

        Toko::create($request->all());
        return redirect()->route('toko.index')
            ->with('success', 'Toko created successfully.');
    }

    public function show(Toko $toko)
    {
        return view('toko.show', compact('toko'));
    }

    public function edit(Toko $toko)
    {
        return view('toko.edit', compact('toko'));
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'nama_toko' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required'
        ]);

        $toko->update($request->all());
        return redirect()->route('toko.index')
            ->with('success', 'Toko updated successfully.');
    }

    public function destroy(Toko $toko)
    {
        $toko->delete();
        return redirect()->route('toko.index')
            ->with('success', 'Toko deleted successfully.');
    }
}
