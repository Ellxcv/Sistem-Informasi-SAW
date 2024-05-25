<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilSaw; // Sesuaikan dengan model yang digunakan untuk hasil SAW

class DashboardController extends Controller
{
    public function showSawResults()
    {
        $hasilSaw = HasilSaw::orderBy('nilai_saw', 'desc')->get();
        
        if ($hasilSaw->isEmpty()) {
            return view('empty_saw_results'); // Jika hasil SAW kosong, tampilkan tampilan khusus
        } else {
            return view('dashboard')->with('hasilSaw', $hasilSaw); // Jika hasil SAW tidak kosong, tampilkan dashboard dengan hasil SAW
        }
    }
    
}
