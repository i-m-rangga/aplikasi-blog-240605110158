@extends('layouts.public')

@section('title', $kategoriAktif ? 'Artikel: ' . $kategoriAktif->nama_kategori : 'Beranda')
@section('meta_description', 'Baca artikel terbaru dan terpilih di Nusantara News. Temukan informasi seputar berbagai kategori menarik.')

@section('hero')
<div class="hero-strip">
    <div class="container">
        <h1><i class="bi bi-journal-richtext me-2"></i>Nusantara News</h1>
        <p>Artikel terbaru, terpilih, dan informatif untuk Anda</p>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4">

    {{-- ══════════ KONTEN UTAMA ══════════ --}}
    <div class="col-lg-8">

        {{-- Filter aktif info --}}
        @if($kategoriAktif)
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0" style="font-family:'Playfair Display',serif; font-size:1.1rem;">
                <i class="bi bi-tag-fill me-1 text-success"></i>
                Artikel dalam kategori: <strong>{{ $kategoriAktif->nama_kategori }}</strong>
            </h5>
            <a href="{{ route('blog.beranda') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-x-circle me-1"></i>Hapus Filter
            </a>
        </div>
        @else
        <h5 class="mb-3" style="font-family:'Playfair Display',serif; font-size:1.1rem; color:#2C3E50;">
            <i class="bi bi-clock-history me-1 text-success"></i> Artikel Terbaru
        </h5>
        @endif

        {{-- Daftar Artikel --}}
        @forelse($artikels as $item)
        <div class="article-card">
            {{-- Cover Image --}}
            @if($item->gambar)
            <img src="{{ asset('storage/gambar/' . $item->gambar) }}"
                 alt="{{ $item->judul }}" class="cover">
            @else
            <div style="width:100%;height:210px;background:linear-gradient(135deg,#2C3E50,#27AE60);
                        display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image text-white" style="font-size:2.5rem;opacity:.5;"></i>
            </div>
            @endif

            <div class="card-body">
                {{-- Badge Kategori --}}
                @if($item->kategori)
                <a href="{{ route('blog.beranda', ['kategori' => $item->id_kategori]) }}"
                   class="badge-kategori" style="text-decoration:none;">
                    <i class="bi bi-tag me-1"></i>{{ $item->kategori->nama_kategori }}
                </a>
                @endif

                {{-- Judul --}}
                <h5 class="judul">{{ $item->judul }}</h5>

                {{-- Meta info --}}
                <div class="meta-info">
                    <span>
                        <i class="bi bi-person"></i>
                        {{ $item->penulis ? $item->penulis->nama_depan . ' ' . $item->penulis->nama_belakang : 'Anonim' }}
                    </span>
                    <span class="mx-2">&bull;</span>
                    <span>
                        <i class="bi bi-calendar3"></i>
                        {{ $item->hari_tanggal ? \Carbon\Carbon::parse($item->hari_tanggal)->translatedFormat('d F Y') : '-' }}
                    </span>
                </div>

                {{-- Cuplikan isi --}}
                <p class="snippet">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 160) }}</p>

                {{-- Tombol Baca Selengkapnya --}}
                <a href="{{ route('blog.detail', $item->id) }}" class="btn-baca">
                    Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state sidebar-widget">
            <i class="bi bi-file-earmark-text"></i>
            <p class="mb-0 fw-semibold">Belum ada artikel yang tersedia.</p>
            <p class="text-muted small mt-1">Silakan kembali lagi nanti.</p>
        </div>
        @endforelse

    </div>{{-- end col-lg-8 --}}

    {{-- ══════════ SIDEBAR ══════════ --}}
    <div class="col-lg-4">

        {{-- Widget Kategori --}}
        <div class="sidebar-widget">
            <div class="widget-title"><i class="bi bi-grid me-1"></i>Kategori Artikel</div>

            @forelse($kategoris as $kat)
            <a href="{{ route('blog.beranda', ['kategori' => $kat->id]) }}"
               class="category-link {{ (isset($kategoriAktif) && $kategoriAktif && $kategoriAktif->id == $kat->id) ? 'active' : '' }}">
                <span><i class="bi bi-chevron-right me-1"></i>{{ $kat->nama_kategori }}</span>
                <span class="badge rounded-pill"
                      style="background:#e8f5e9;color:#1e8449;font-size:.72rem;">
                    {{ $kat->artikel->count() }}
                </span>
            </a>
            @empty
            <p class="text-muted small mb-0">Belum ada kategori.</p>
            @endforelse

            @if($kategoris->count() > 0)
            <div class="mt-2 pt-1 border-top">
                <a href="{{ route('blog.beranda') }}" class="category-link"
                   style="color:#888;font-size:.82rem;">
                    <span><i class="bi bi-collection me-1"></i>Tampilkan Semua</span>
                </a>
            </div>
            @endif
        </div>

        {{-- Widget Info --}}
        <div class="sidebar-widget">
            <div class="widget-title"><i class="bi bi-info-circle me-1"></i>Tentang Blog</div>
            <p class="small text-muted mb-0" style="line-height:1.7;">
                Blog ini dikelola menggunakan <strong>Nusantara News</strong> berbasis Laravel 11.
                Berisi artikel-artikel informatif yang dikurasi oleh para penulis kami.
            </p>
        </div>

    </div>{{-- end col-lg-4 --}}

</div>
@endsection
