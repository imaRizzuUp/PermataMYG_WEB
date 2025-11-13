<?php

namespace App\Http\Controllers;

// Import semua kelas yang dibutuhkan
use App\Models\AdminPermata;
use App\Models\Anggota;
use App\Models\JadwalIbadah;
use App\Models\StoreBerita; // <-- Perbaikan casing
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AppController extends Controller
{
    public function dashboard()
    {
        $title = 'Dashboard Utama';

        $jumlahAdmin = AdminPermata::count();
        $jumlahAnggota = Anggota::count();
        $jumlahBerita = StoreBerita::count();
        $jumlahJadwalTotal = JadwalIbadah::count();
        $jumlahJadwalMenunggu = JadwalIbadah::where('status', 'menunggu')->count();

        $jadwalBerikutnya = JadwalIbadah::where('status', 'menunggu')
                                    ->where('tanggal_ibadah', '>=', now()->toDateString())
                                    ->orderBy('tanggal_ibadah', 'asc')
                                    ->take(3)
                                    ->get();

        $beritaTerbaru = StoreBerita::with('admin.anggota')->latest()->take(5)->get();

        return view('dashboard', compact(
            'title', 'jumlahAdmin', 'jumlahAnggota', 'jumlahBerita',
            'jumlahJadwalTotal', 'jumlahJadwalMenunggu', 'jadwalBerikutnya', 'beritaTerbaru'
        ));
    }
    
    public function daftaradmin() {
        $admins = AdminPermata::with('anggota')->get();

        $jabatanOrder = [
            'admin' => 1, 'ketua' => 2, 'wakil ketua' => 3, 'sekretaris' => 4,
            'wakil sekretaris' => 5, 'bendahara' => 6, 'wakil bendahara' => 7,
            'pimpinan bidang' => 8, 'kakak pembimbing' => 9,
        ];

        $sortedAdmins = $admins->sortBy(function($admin) use ($jabatanOrder) {
            return $jabatanOrder[strtolower($admin->jabatan)] ?? 99;
        });

        return view('daftaradmin', [
            'title' => 'Daftar Admin',
            'admins' => $sortedAdmins,
        ]);
    }

    // =======================================================
    // === METHOD DESTROY FINAL YANG BEBAS DARI GARIS MERAH ===
    // =======================================================
    
    /**
     * Menghapus data admin dari database.
     */
    public function destroy(Request $request, AdminPermata $admin)
    {
        // 1. Lindungi endpoint dengan Gate
        if (! Gate::allows('delete-admin')) {
            abort(403, 'AKSI TIDAK DIIZINKAN');
        }

        // 2. Gunakan $request->user()->id untuk mencegah "garis merah"
        //    dan juga untuk keamanan agar tidak menghapus diri sendiri.
        if ($request->user()->id === $admin->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        // 3. Hapus data jika semua pemeriksaan lolos
        $admin->delete();

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('daftaradmin')->with('success', 'Akun admin berhasil dihapus.');
    }

    public function buatBerita() {
        $beritas = StoreBerita::with('admin.anggota')->latest()->get();
        return view('buatBerita', compact('beritas'));
    }

    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:150',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi'    => 'required|string',
        ]);

        $validated['admin_permata_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('uploads/berita', 'public');
        }

        StoreBerita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    public function jadwal_ibadah()
    {
        $title = 'Jadwal Ibadah';
        $jadwalIbadahs = JadwalIbadah::latest()->get();
        return view('jadwal-ibadah.index', compact('title', 'jadwalIbadahs'));
    }

    public function jadwal_ibadah_store(Request $request)
    {
        $validated = $request->validate([
            'nama_ibadah' => 'required|string|max:255',
            'lokasi_ibadah' => 'required|string|max:255',
            'tanggal_ibadah' => 'required|date',
        ]);
        JadwalIbadah::create($validated);
        return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil ditambahkan.');
    }

    public function jadwal_ibadah_update(Request $request, JadwalIbadah $jadwalIbadah)
    {
        $validated = $request->validate([
            'nama_ibadah' => 'required|string|max:255',
            'lokasi_ibadah' => 'required|string|max:255',
            'tanggal_ibadah' => 'required|date',
            'status' => ['required', Rule::in(['menunggu', 'berhasil', 'gagal'])],
        ]);
        $jadwalIbadah->update($validated);
        return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil diperbarui.');
    }

    public function jadwal_ibadah_destroy(JadwalIbadah $jadwalIbadah)
    {
        $jadwalIbadah->delete();
        return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil dihapus.');
    }

    public function showStatistik()
    {
        $title = 'Statistik Ibadah';
        $jadwalSelesai = JadwalIbadah::whereIn('status', ['berhasil', 'gagal'])->get();
        $totalIbadah = $jadwalSelesai->count();
        $berhasil = $jadwalSelesai->where('status', 'berhasil')->count();
        $gagal = $totalIbadah - $berhasil;
        $rasioBerhasil = ($totalIbadah > 0) ? ($berhasil / $totalIbadah) * 100 : 0;
        $statistikData = [
            'totalIbadah' => $totalIbadah,
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'rasioBerhasil' => round($rasioBerhasil, 2),
        ];
        return view('statistik', compact('title', 'statistikData'));
    }
}