<?php

namespace App\Http\Controllers;

use App\Models\HasilSaw;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class HasilSawController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->input('orderBy', 'id_hasil');
        $orderDirection = $request->input('orderDirection', 'asc');
        $pageSize = $request->input('pageSize', 10);

        $hasilSaws = HasilSaw::orderBy($orderBy, $orderDirection)->paginate($pageSize);

        return view('hasil_saw.index', compact('hasilSaws'));
    }

    public function create()
    {
        return view('hasil_saw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'nilai_saw' => 'required'
        ]);

        HasilSaw::create($request->all());
        return redirect()->route('hasil_saw.index')->with('success', 'Hasil Saw created successfully.');
    }

    public function show(HasilSaw $hasilSaw)
    {
        return view('hasil_saw.show', compact('hasilSaw'));
    }

    public function edit($id_hasil)
    {
        // Mengambil data hasil saw berdasarkan ID
        $hasilSaw = HasilSaw::findOrFail($id_hasil);
    
        // Mengambil data alternatif untuk dropdown
        $alternatifs = Alternatif::all();
    
        // Jika hasil saw tidak ditemukan, redirect dengan pesan error
        if (!$hasilSaw) {
            return redirect()->route('hasil_saw.index')->with('error', 'Hasil Saw not found.');
        }
    
        // Menampilkan view edit hasil saw beserta data yang diperlukan
        return view('hasil_saw.edit', compact('hasilSaw', 'alternatifs'));
    }
    

    public function update(Request $request, HasilSaw $hasilSaw)
    {
        $request->validate([
            'id_alternatif' => 'required',
            'nilai_saw' => 'required'
        ]);

        $hasilSaw->update($request->all());
        return redirect()->route('hasil_saw.index')->with('success', 'Hasil Saw updated successfully.');
    }

    public function destroy(HasilSaw $hasilSaw)
    {
        $hasilSaw->delete();
        return redirect()->route('hasil_saw.index')->with('success', 'Hasil Saw deleted successfully.');
    }

    public function print()
    {
        // Ambil data hasil yang ingin dicetak dari model atau sumber data lainnya
        $hasilSaw = HasilSaw::all(); // Anda harus mengambil data yang sesuai dari database atau sumber data lainnya

        // Render view ke dalam string
        $html = view('print.hasil', compact('hasilSaw'))->render();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Buat opsi untuk PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Terapkan opsi
        $dompdf->setOptions($options);

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Menghasilkan nama file untuk disimpan
        $filename = 'hasil.pdf';

        // Mengembalikan file PDF sebagai respons
        return $dompdf->stream($filename);
    }

}
