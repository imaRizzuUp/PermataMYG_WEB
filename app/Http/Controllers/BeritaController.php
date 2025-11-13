<?php

namespace App\Http\Controllers;

use App\Models\storeBerita; // Pastikan nama Model Anda benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk manajemen file

class BeritaController extends Controller
{
    // --- METHOD UNTUK ADMIN ---

    public function index()
    {
        $data = [
            'title' => 'Buat Berita',
        ];

        $beritas = storeBerita::latest()->get();
        return view('berita.index', compact('beritas'), $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:150',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi' => 'required|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads/berita', 'public');
        }

        storeBerita::create([
            'admin_permata_id' => Auth::id(),
            'judul'  => $request->judul,
            'gambar' => $gambarPath,
            'isi'    => $request->isi,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $berita = storeBerita::findOrFail($id);

        $request->validate([
            'judul'  => 'required|string|max:150',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi'    => 'required|string', // Perbaikan: 'isi' bukan 'deskripsi'
        ]);

        $gambarPath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada untuk menghemat ruang
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('uploads/berita', 'public');
        }

        $berita->update([
            'judul'  => $request->judul,
            'gambar' => $gambarPath,
            'isi'    => $request->isi, // Perbaikan: 'isi' bukan 'deskripsi'
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = storeBerita::findOrFail($id);
        // Hapus juga file gambarnya
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }

    // ==================================================================
    // == METHOD UNTUK TAMPILAN GUEST / PENGUNJUNG
    // ==================================================================

    /**
     * Menampilkan halaman daftar semua berita untuk pengunjung.
     */
    public function showAll()
    {
        $beritas = storeBerita::latest()->paginate(9); // Gunakan paginate untuk halaman yang lebih cepat
        return view('berita.show', compact('beritas'));
    }

    /**
     * METHOD BARU: Menampilkan halaman detail dari satu berita.
     */
    public function show(storeBerita $berita)
    {
        // Berkat Route Model Binding di file routes/web.php,
        // Laravel secara otomatis menemukan berita berdasarkan ID di URL.
        // Kita tidak perlu menulis kode pencarian manual.

        // Opsional: Ambil beberapa berita lain sebagai rekomendasi
        $beritaLain = storeBerita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        // Kirim data berita yang ditemukan dan berita lainnya ke view
        return view('berita.detail', compact('berita', 'beritaLain'));
    }
}