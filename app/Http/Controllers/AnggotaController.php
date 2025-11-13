<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnggotaController extends Controller
{
    public function index()
    {
        $title = 'Anggota Terdaftar';
        $anggotas = Anggota::latest()->get();
        return view('anggota.index', compact('title', 'anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);
        Anggota::create($validated);
        return back()->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    public function destroy(Request $request,Anggota $anggota) {
        if (! Gate::allows('delete-anggota')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus anggota.');
        }

        if ($request->user()->anggota_id === $anggota->id) {
            return back()->with('error', 'Anda tidak dapat menghapus data anggota yang tertaut dengan akun admin Anda.');
        }

        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
