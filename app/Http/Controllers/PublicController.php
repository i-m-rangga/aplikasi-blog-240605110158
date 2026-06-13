<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    /**
     * Halaman Beranda Publik
     * Menampilkan 5 artikel terbaru, dengan filter kategori opsional.
     */
    public function beranda(Request $request)
    {
        $kategoris = KategoriArtikel::orderBy('nama_kategori')->get();

        $query = Artikel::with(['penulis', 'kategori'])->orderBy('id', 'desc');

        $kategoriAktif = null;
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
            $kategoriAktif = KategoriArtikel::find($request->kategori);
        }

        $artikels = $query->take(5)->get();

        return view('public.beranda', compact('artikels', 'kategoris', 'kategoriAktif'));
    }

    /**
     * Halaman Detail Artikel Publik
     * Menampilkan satu artikel lengkap dan artikel terkait dari kategori yang sama.
     */
    public function detail($id)
    {
        $artikel = Artikel::with(['penulis', 'kategori'])->findOrFail($id);

        $artikelTerkait = Artikel::with(['penulis', 'kategori'])
            ->where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $kategoris = KategoriArtikel::orderBy('nama_kategori')->get();

        return view('public.detail', compact('artikel', 'artikelTerkait', 'kategoris'));
    }
}
