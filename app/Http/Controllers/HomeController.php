<?php

namespace App\Http\Controllers;

use App\Models\storeBerita;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $beritas = storeBerita::all();

        $jadwalIbadahs = JadwalIbadah::where('status', 'menunggu')
                                     ->where('tanggal_ibadah', '>=', now()->toDateString())
                                     ->orderBy('tanggal_ibadah', 'asc')
                                     ->take(3)
                                     ->get();

        return view('welcome', compact('beritas', 'jadwalIbadahs'));
    }


}
