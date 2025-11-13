<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\adminPermata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // =============================================
    // == METHOD LAMA KAMU (TIDAK ADA PERUBAHAN) ==
    // =============================================

    public function form_register() {
        $anggotas = Anggota::orderBy('nama', 'asc')->get(['id', 'nama']);

        return view('auth.register', [
            'anggotas' => $anggotas
        ]);
    }

    public function login() {
        return view('auth.login');
    }

    public function registrasi(Request $request) {
        $request->validate([
        'anggota_id' => 'required|exists:anggotas,id|unique:admin_permatas,anggota_id',
        'email' => 'required|string|email|max:255|unique:admin_permatas',
        'password' => 'required|string|min:8',
        'jabatan' => 'required|string',
        ]);

    
    AdminPermata::create([
        
        'anggota_id' => $request->anggota_id,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('daftaradmin')->with('success', 'Admin baru berhasil dibuat.');
    }

    // METHOD BARU UNTUK REKOMENDASI NAMA
    public function searchAnggota(Request $request)
    {
        $query = $request->get('q');
        if ($query) {
            $anggotas = Anggota::where('nama', 'LIKE', "%{$query}%")
                                ->whereDoesntHave('admin') // Hanya cari anggota yang BUKAN admin
                                ->limit(5)
                                ->get(['id', 'nama']);
            return response()->json($anggotas);
        }
        return response()->json([]);
    }

    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|string|email',
            'password'  => 'required|string|min:8',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password Salah.'])->onlyInput('email');
    }
    
    // ==================================================
    // == METHOD-METHOD BARU UNTUK PENGATURAN AKUN ==
    // ==================================================

    /**
     * Menampilkan halaman pengaturan akun.
     */
    public function showSettings()
    {
        $title = 'Pengaturan Akun';
        return view('auth.akunsettings', ['title' => $title, 'user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin_permatas,email,' . $userId,
        ]);

        // =======================================================
        // == INI PERBAIKANNYA: Ambil data BARU dari database ==
        // =======================================================
        $user = adminPermata::findOrFail($userId);
        
        // Isi data baru dari hasil validasi
        $user->fill($validated);

        // Simpan. Ini sekarang pasti berhasil.
        $user->save();

        return back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // =======================================================
        // == PERBAIKANNYA DITERAPKAN DI SINI JUGA ==
        // =======================================================
        $user = adminPermata::findOrFail(Auth::id());

        $user->password = Hash::make($validated['password']);
        
        $user->save();

        return back()->with('status', 'password-updated');
    }

    public function destroyAccount(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'account-deleted');
    }
}