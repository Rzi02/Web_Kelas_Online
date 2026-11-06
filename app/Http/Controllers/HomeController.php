<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Kelas;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        $kelas = Kelas::with('kategori')
            ->where('status', 'published')
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('id_kategori', $request->kategori);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(6);

        return view('home', compact('kategori', 'kelas'));
    }
}