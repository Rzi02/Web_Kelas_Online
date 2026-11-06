<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class KelasController extends Controller
{
    public function show($id)
    {
        $kelas = Kelas::with('kategori')
            ->where('status', 'published')
            ->findOrFail($id);

        return view('kelas.detail', compact('kelas'));
    }
}
