<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::with('user');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $pengumuman = $query->latest()->paginate(10);
        $kategoriList = Pengumuman::select('kategori')->distinct()->pluck('kategori');

        return view('pengumuman.index', compact('pengumuman', 'kategoriList'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $pengumuman->update($request->only(['judul', 'isi', 'kategori']));

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }
}
