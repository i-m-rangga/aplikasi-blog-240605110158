@extends('layouts.public')

@section('title', $artikel->judul)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($artikel->isi), 155))

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('blog.beranda') }}"><i class="bi bi-house-door me-1"></i>Beranda</a>
        </li>
        @if($artikel->kategori)
        <li class="breadcrumb-item">
            <a href="{{ route('blog.beranda', ['kategori' => $artikel->id_kategori]) }}">
                {{ $artikel->kategori->nama_kategori }}
            </a>
        </li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">
            {{ \Illuminate\Support\Str::limit($artikel->judul, 50) }}
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row g-4">

    {{-- ══════════ KONTEN UTAMA ══════════ --}}
    <div class="col-lg-8">
        <article class="sidebar-widget p-0" style="border-radius:10px;overflow:hidden;">

            {{-- Cover Image Penuh --}}
            @if($artikel->gambar)
            <img src="{{ asset('storage/gambar/' . $artikel->gambar) }}"
                 alt="{{ $artikel->judul }}"
                 style="width:100%;max-height:420px;object-fit:cover;">
            @else
            <div style="width:100%;height:280px;background:linear-gradient(135deg,#2C3E50,#27AE60);
                        display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image text-white" style="font-size:3rem;opacity:.4;"></i>
            </div>
            @endif

            <div class="p-4">
                {{-- Badge Kategori --}}
                @if($artikel->kategori)
                <a href="{{ route('blog.beranda', ['kategori' => $artikel->id_kategori]) }}"
                   class="badge-kategori mb-3" style="text-decoration:none;">
                    <i class="bi bi-tag me-1"></i>{{ $artikel->kategori->nama_kategori }}
                </a>
                @endif

                {{-- Judul Besar --}}
                <h1 style="font-family:'Playfair Display',serif;font-size:1.75rem;color:#2C3E50;
                            line-height:1.35;margin-bottom:.9rem;">
                    {{ $artikel->judul }}
                </h1>

                {{-- Meta: Penulis & Tanggal --}}
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom"
                     style="font-size:.85rem;color:#6c757d;">

                    @if($artikel->penulis && $artikel->penulis->foto)
                    <img src="{{ asset('storage/foto/' . $artikel->penulis->foto) }}"
                         alt="{{ $artikel->penulis->nama_depan }}"
                         style="width:38px;height:38px;border-radius:50%;object-fit:cover;
                                border:2px solid #e9ecef;">
                    @else
                    <div style="width:38px;height:38px;border-radius:50%;background:#e8f5e9;
                                display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-person" style="color:#27AE60;"></i>
                    </div>
                    @endif

                    <div>
                        <div class="fw-semibold" style="color:#444;">
                            {{ $artikel->penulis
                                ? $artikel->penulis->nama_depan . ' ' . $artikel->penulis->nama_belakang
                                : 'Anonim' }}
                        </div>
                        <div>
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $artikel->hari_tanggal
                                ? \Carbon\Carbon::parse($artikel->hari_tanggal)->translatedFormat('d F Y')
                                : '-' }}
                        </div>
                    </div>
                </div>

                {{-- Isi Artikel Lengkap --}}
                <div class="article-body" style="line-height:1.85;font-size:.95rem;color:#444;">
                    {!! nl2br(e($artikel->isi)) !!}
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('blog.beranda') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                    </a>
                    @if($artikel->kategori)
                    <a href="{{ route('blog.beranda', ['kategori' => $artikel->id_kategori]) }}"
                       class="btn btn-sm rounded-pill ms-2"
                       style="background:#e8f5e9;color:#1e8449;border:none;">
                        <i class="bi bi-tag me-1"></i>Lihat Kategori Serupa
                    </a>
                    @endif
                </div>
            </div>
        </article>
    </div>{{-- end col-lg-8 --}}

    {{-- ══════════ SIDEBAR ══════════ --}}
    <div class="col-lg-4">

        {{-- Widget Artikel Terkait --}}
        <div class="sidebar-widget">
            <div class="widget-title">
                <i class="bi bi-layers me-1"></i>Artikel Terkait
            </div>

            @forelse($artikelTerkait as $terkait)
            <a href="{{ route('blog.detail', $terkait->id) }}" class="related-card">
                @if($terkait->gambar)
                <img src="{{ asset('storage/gambar/' . $terkait->gambar) }}"
                     alt="{{ $terkait->judul }}">
                @else
                <div style="width:64px;height:52px;border-radius:6px;background:linear-gradient(135deg,#2C3E50,#27AE60);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-image text-white" style="font-size:.9rem;opacity:.6;"></i>
                </div>
                @endif
                <div>
                    <div class="rc-title">{{ \Illuminate\Support\Str::limit($terkait->judul, 55) }}</div>
                    <div class="rc-date">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $terkait->hari_tanggal
                            ? \Carbon\Carbon::parse($terkait->hari_tanggal)->translatedFormat('d M Y')
                            : '-' }}
                    </div>
                </div>
            </a>
            @empty
            <div class="text-muted small text-center py-2">
                <i class="bi bi-info-circle me-1"></i>Tidak ada artikel terkait.
            </div>
            @endforelse
        </div>

        {{-- Widget Kategori --}}
        <div class="sidebar-widget">
            <div class="widget-title"><i class="bi bi-grid me-1"></i>Jelajahi Kategori</div>

            @foreach($kategoris as $kat)
            <a href="{{ route('blog.beranda', ['kategori' => $kat->id]) }}"
               class="category-link {{ $artikel->id_kategori == $kat->id ? 'active' : '' }}">
                <span><i class="bi bi-chevron-right me-1"></i>{{ $kat->nama_kategori }}</span>
            </a>
            @endforeach
        </div>

    </div>{{-- end col-lg-4 --}}

</div>
@endsection
