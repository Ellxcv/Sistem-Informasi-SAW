<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'nama_gudang');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10);

        $gudangs = Gudang::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('gudang.index', compact('gudangs'));
    }
    
    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'lokasi' => 'required'
        ]);

        Gudang::create($request->all());
        return redirect()->route('gudang.index')->with('success', 'Gudang created successfully.');
    }

    public function show(Gudang $gudang)
    {
        return view('gudang.show', compact('gudang'));
    }

    public function edit(Gudang $gudang)
    {
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'lokasi' => 'required'
        ]);

        $gudang->update($request->all());
        return redirect()->route('gudang.index')->with('success', 'Gudang updated successfully.');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect()->route('gudang.index')->with('success', 'Gudang deleted successfully.');
    }
}
