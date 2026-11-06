<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $kelas = Kelas::with('kategori')->latest()->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('admin.kelas.create', compact('kategori'));
    }

    // Menyimpan kelas baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'instruktur' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kelas', 'public');
        }

        Kelas::create($data);

        return redirect()->route('admin.kelas')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('admin.kelas.edit', compact('kelas', 'kategori'));
    }

    // Memperbarui kelas
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $data = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'instruktur' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kelas->gambar) {
                Storage::disk('public')->delete($kelas->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('kelas', 'public');
        }

        $kelas->update($data);

        return redirect()->route('admin.kelas')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    // Menghapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        if ($kelas->pendaftaran()->exists()) {
            return back()->with('error', 'Kelas tidak bisa dihapus karena sudah memiliki pendaftaran.');
        }

        if ($kelas->gambar) {
            Storage::disk('public')->delete($kelas->gambar);
        }

        $kelas->delete();

        return redirect()->route('admin.kelas')
            ->with('success', 'Kelas telah berhasil dihapus.');
    }
}