<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengirimanController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_pengiriman');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10); // Ambil nilai pageSize dari permintaan

        // Query untuk mengambil data pengiriman dengan pengurutan dan pembagian halaman
        $pengirimans = Pengiriman::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('pengiriman.index', compact('pengirimans'));
    }

    public function create()
    {
        return view('pengiriman.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validatePengiriman($request->all());

        if ($validator->fails()) {
            return redirect()->route('pengiriman.create')
                ->withErrors($validator)
                ->withInput();
        }

        Pengiriman::create($request->all());
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman created successfully.');
    }

    public function show(Pengiriman $pengiriman)
    {
        return view('pengiriman.show', compact('pengiriman'));
    }

    public function edit(Pengiriman $pengiriman)
    {
        return view('pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
        $validator = $this->validatePengiriman($request->all());

        if ($validator->fails()) {
            return redirect()->route('pengiriman.edit', $pengiriman->id_pengiriman)
                ->withErrors($validator)
                ->withInput();
        }

        $pengiriman->update($request->all());
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman updated successfully.');
    }

    public function destroy(Pengiriman $pengiriman)
    {
        $pengiriman->delete();
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman deleted successfully.');
    }

    protected function validatePengiriman(array $data)
    {
        return Validator::make($data, [
            'id_barang' => 'required',
            'id_gudang' => 'required',
            'tanggal_kirim' => 'required|date',
            'jumlah' => 'required|numeric',
            'id_toko' => 'required',
            'id_kendaraan' => 'required',
            'id_supir' => 'required',
        ]);
    }
}
