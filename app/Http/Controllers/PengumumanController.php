<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        session(['pengumuman_dilihat' => true]);
        session()->save();

        $user = Auth::user();

        // Query awal untuk pencarian dan filter
        $query = Pengumuman::with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('isi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Ambil semua pengumuman (yang sesuai filter) untuk ditandai sebagai dibaca
        $pengumumanList = $query->get();

        foreach ($pengumumanList as $pengumuman) {
            // Jika belum dibaca oleh user ini, tandai sebagai dibaca
            if (!$pengumuman->dibacaOleh()->where('user_id', $user->id)->exists()) {
                $pengumuman->dibacaOleh()->attach($user->id, ['read_at' => now()]);
            }
        }

        // Hitung jumlah pengumuman yang belum dibaca (untuk icon bell)
        $unreadCount = Pengumuman::whereDoesntHave('dibacaOleh', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        // Ambil daftar kategori unik
        $kategoriList = Pengumuman::select('kategori')->distinct()->pluck('kategori');

        // Urutkan berdasarkan tanggal terbaru dan paginate
        $pengumuman = $query->latest()->paginate(10);

        return view('pengumuman.index', compact('pengumuman', 'kategoriList', 'unreadCount'));
    }



    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'gambar' => 'nullable|image|max:2048', // max 2MB
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Update data teks
        $pengumuman->update($request->only(['judul', 'isi', 'kategori']));

        // Handle gambar jika ada upload baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('pengumuman', 'public');
            $pengumuman->update(['gambar' => $gambarPath]);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Hapus gambar jika ada
        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman dan gambar terkait berhasil dihapus.');
    }
}
