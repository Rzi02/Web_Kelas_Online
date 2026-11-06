<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pendaftar;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Enums\StatusPendaftaran;

class PendaftaranController extends Controller
{
    // Menampilkan data pendaftaran di admin
    public function index()
    {
        $pendaftaran = Pendaftaran::with([
            'kelas.kategori',
            'pendaftar'
        ])
        ->latest()
        ->paginate(10);

        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    // Menyimpan pendaftaran dari pengunjung
    public function store(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
        ]);

        $kelas = Kelas::where('status', 'published')
            ->findOrFail($id);

        $pendaftar = Pendaftar::firstOrCreate(
            ['email' => $request->email],
            [
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
            ]
        );

        // Memeriksa apakah sudah pernah mendaftar
        $sudahDaftar = Pendaftaran::where('id_kelas', $kelas->id_kelas)
            ->where('id_pendaftar', $pendaftar->id_pendaftar)
            ->exists();

        if ($sudahDaftar) {
            return back()->with(
                'error',
                'Anda sudah mendaftar kelas ini.'
            );
        }

        Pendaftaran::create([
            'id_kelas' => $kelas->id_kelas,
            'id_pendaftar' => $pendaftar->id_pendaftar,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Pendaftaran berhasil dikirim!'
        );
    }

    // Mengubah status pendaftaran
    public function updateStatus(Request $request, int $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        // Mengambil status saat ini
        $statusSekarang = $pendaftaran->status instanceof StatusPendaftaran
            ? $pendaftaran->status->value
            : $pendaftaran->status;

        // Status yang sudah diproses tidak boleh diubah
        if ($statusSekarang !== 'pending') {
            return back()->with(
                'error',
                'Pendaftaran sudah diproses dan status tidak dapat diubah lagi.'
            );
        }

        $pendaftaran->update([
            'status' => $data['status'],
        ]);

        return redirect()->route('admin.pendaftaran')
            ->with(
                'success',
                'Status pendaftaran berhasil diperbarui.'
            );
    }

    // Menampilkan halaman cek status
    public function cekStatus()
    {
        return view('pendaftaran.cek-status');
    }

    // Memeriksa status pendaftaran berdasarkan email
    public function hasilStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $pendaftaran = Pendaftaran::with([
            'kelas.kategori',
            'pendaftar'
        ])
        ->whereHas('pendaftar', function ($query) use ($request) {
            $query->where('email', $request->email);
        })
        ->latest()
        ->get();

        return view(
            'pendaftaran.cek-status',
            compact('pendaftaran')
        );
    }
}
