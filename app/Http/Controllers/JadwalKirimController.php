<?php

namespace App\Http\Controllers;

use App\Models\JadwalKirim;
use Illuminate\Http\Request;

class JadwalKirimController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'tanggal_kirim');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data jadwal kirim dengan pengurutan dan pembagian halaman
        $jadwalKirim = JadwalKirim::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('jadwal_kirim.index', compact('jadwalKirim'));
    }

    public function create()
    {
        return view('jadwal_kirim.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengiriman' => 'required',
            'tanggal_kirim' => 'required',
            'status' => 'required',
        ]);

        JadwalKirim::create($request->all());
        return redirect()->route('jadwal_kirim.index')
            ->with('success', 'Jadwal kirim created successfully.');
    }

    public function show(JadwalKirim $jadwalKirim)
    {
        return view('jadwal_kirim.show', compact('jadwalKirim'));
    }

    public function edit(JadwalKirim $jadwalKirim)
    {
        return view('jadwal_kirim.edit', compact('jadwalKirim'));
    }

    public function update(Request $request, JadwalKirim $jadwalKirim)
    {
        $request->validate([
            'id_pengiriman' => 'required',
            'tanggal_kirim' => 'required',
            'status' => 'required',
        ]);

        $jadwalKirim->update($request->all());
        return redirect()->route('jadwal_kirim.index')
            ->with('success', 'Jadwal kirim updated successfully.');
    }

    public function destroy(JadwalKirim $jadwalKirim)
    {
        $jadwalKirim->delete();
        return redirect()->route('jadwal_kirim.index')
            ->with('success', 'Jadwal kirim deleted successfully.');
    }
}
