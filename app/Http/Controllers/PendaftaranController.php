<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Menampilkan data pendaftaran di halaman admin
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['kelas', 'pendaftar'])
            ->latest()
            ->paginate(10);

        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    // Menyimpan pendaftaran dari user
    public function store(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
        ]);

        $kelas = Kelas::where('status', 'published')->findOrFail($id);

        $pendaftar = Pendaftar::firstOrCreate(
            ['email' => $request->email],
            [
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
            ]
        );

        $sudahDaftar = Pendaftaran::where('id_kelas', $id)
            ->where('id_pendaftar', $pendaftar->id_pendaftar)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah mendaftar kelas ini.');
        }

        Pendaftaran::create([
            'id_kelas' => $id,
            'id_pendaftar' => $pendaftar->id_pendaftar,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
    }

    // Mengubah status pendaftaran oleh admin
    public function updateStatus(Request $request, int $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($data);

        return redirect()->route('admin.pendaftaran')
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // Menampilkan halaman cek status untuk user
    public function cekStatus()
    {
        return view('pendaftaran.cek-status');
    }

    // Mencari pendaftaran berdasarkan email user
    public function hasilStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $pendaftaran = Pendaftaran::with(['kelas', 'pendaftar'])
            ->whereHas('pendaftar', function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->latest()
            ->get();

        return view('pendaftaran.cek-status', compact('pendaftaran'));
    }
}