<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Toko;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::paginate(10);
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $tokos = Toko::all();
        return view('pegawai.create', compact('tokos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'nomor_telepon' => 'required',
            'id_toko' => 'required'
        ]);

        Pegawai::create($request->all());
        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai created successfully.');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        $tokos = Toko::all();
        return view('pegawai.edit', compact('pegawai', 'tokos'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'nomor_telepon' => 'required',
            'id_toko' => 'required'
        ]);

        $pegawai->update($request->all());
        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai updated successfully.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai deleted successfully.');
    }
}
