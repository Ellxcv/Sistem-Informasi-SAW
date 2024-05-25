<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB; // tambahkan penggunaan DB untuk kueri

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_kriteria');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10);

        // Mengambil data kriteria dengan pagination dan sorting
        $kriterias = Kriteria::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        // Menambahkan query string pada pagination links
        $kriterias->appends($request->all());

        // Mengirimkan data ke view
        return view('kriteria.index', compact('kriterias', 'orderBy', 'orderDirection', 'pageSize'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'deskripsi' => 'required',
            'bobot' => 'required|numeric',
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria created successfully.');
    }

    public function show(Kriteria $kriteria)
    {
        return view('kriteria.show', compact('kriteria'));
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'deskripsi' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $kriteria->update($request->all());
        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria updated successfully.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria deleted successfully.');
    }
}
