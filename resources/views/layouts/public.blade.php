<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Baca artikel menarik dan informatif di Nusantara News.')">
    <title>@yield('title', 'Nusantara News') | Nusantara News</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:    #2C3E50;
            --accent:     #27AE60;
            --accent-dark:#1e8449;
            --light-bg:   #f8f9fa;
            --border:     #e9ecef;
            --text-muted: #6c757d;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8;
            color: #333;
            font-size: 15px;
        }

        /* ── Navbar ── */
        .public-navbar {
            background-color: var(--primary);
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,.2);
        }
        .public-navbar .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #fff !important;
            letter-spacing: .5px;
        }
        .public-navbar .nav-link {
            color: rgba(255,255,255,.75) !important;
            font-size: .875rem;
            font-weight: 500;
            padding: 1rem .9rem;
            transition: color .2s;
        }
        .public-navbar .nav-link:hover { color: #fff !important; }
        .public-navbar .btn-admin {
            font-size: .8rem;
            padding: .35rem .85rem;
            border: 1px solid rgba(255,255,255,.35);
            color: #fff;
            border-radius: 20px;
            transition: background .2s, border-color .2s;
        }
        .public-navbar .btn-admin:hover {
            background: rgba(255,255,255,.15);
            border-color: rgba(255,255,255,.7);
        }

        /* ── Hero Strip ── */
        .hero-strip {
            background: linear-gradient(135deg, #2C3E50 0%, #27AE60 100%);
            padding: 2.8rem 0 2.2rem;
            color: #fff;
            text-align: center;
        }
        .hero-strip h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: .4rem;
        }
        .hero-strip p {
            font-size: .95rem;
            opacity: .85;
            margin: 0;
        }

        /* ── Main layout ── */
        .main-wrapper {
            max-width: 1140px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* ── Article Card ── */
        .article-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,.07);
            transition: transform .25s, box-shadow .25s;
            margin-bottom: 1.6rem;
            display: flex;
            flex-direction: column;
        }
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,.12);
        }
        .article-card img.cover {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }
        .article-card .card-body {
            padding: 1.25rem 1.4rem 1.4rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .badge-kategori {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .04em;
            background-color: #e8f5e9;
            color: var(--accent-dark);
            border-radius: 20px;
            padding: .25em .75em;
            display: inline-block;
            margin-bottom: .6rem;
        }
        .article-card h5.judul {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            color: var(--primary);
            margin-bottom: .5rem;
            line-height: 1.4;
        }
        .meta-info {
            font-size: .8rem;
            color: var(--text-muted);
            margin-bottom: .75rem;
        }
        .meta-info i { margin-right: .25rem; }
        .snippet {
            font-size: .88rem;
            color: #555;
            line-height: 1.6;
            flex: 1;
            margin-bottom: 1rem;
        }
        .btn-baca {
            font-size: .82rem;
            font-weight: 600;
            color: var(--accent-dark);
            background: #e8f5e9;
            border: none;
            border-radius: 20px;
            padding: .4rem 1.1rem;
            transition: background .2s, color .2s;
            align-self: flex-start;
            text-decoration: none;
        }
        .btn-baca:hover {
            background: var(--accent);
            color: #fff;
        }

        /* ── Sidebar ── */
        .sidebar-widget {
            background: #fff;
            border-radius: 10px;
            padding: 1.2rem 1.3rem;
            box-shadow: 0 1px 4px rgba(0,0,0,.07);
            margin-bottom: 1.4rem;
        }
        .sidebar-widget .widget-title {
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
            padding-bottom: .55rem;
            margin-bottom: .9rem;
        }
        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .5rem .3rem;
            font-size: .88rem;
            color: #444;
            border-bottom: 1px solid #f3f3f3;
            text-decoration: none;
            transition: color .2s;
        }
        .category-link:last-child { border-bottom: none; }
        .category-link:hover, .category-link.active {
            color: var(--accent-dark);
            font-weight: 600;
        }
        .category-link i { font-size: .7rem; }

        /* ── Related article mini card ── */
        .related-card {
            display: flex;
            gap: .75rem;
            padding: .6rem 0;
            border-bottom: 1px solid #f3f3f3;
            text-decoration: none;
            color: inherit;
            align-items: flex-start;
            transition: opacity .2s;
        }
        .related-card:last-child { border-bottom: none; }
        .related-card:hover { opacity: .8; }
        .related-card img {
            width: 64px;
            height: 52px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
        }
        .related-card .rc-title {
            font-size: .83rem;
            font-weight: 600;
            color: var(--primary);
            line-height: 1.35;
            margin-bottom: .25rem;
        }
        .related-card .rc-date {
            font-size: .73rem;
            color: var(--text-muted);
        }

        /* ── Footer ── */
        .public-footer {
            background-color: var(--primary);
            color: rgba(255,255,255,.7);
            text-align: center;
            padding: 1.4rem 1rem;
            margin-top: 3rem;
            font-size: .83rem;
        }
        .public-footer a { color: var(--accent); text-decoration: none; }
        .public-footer a:hover { text-decoration: underline; }

        /* ── Breadcrumb ── */
        .breadcrumb-bar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: .6rem 0;
        }
        .breadcrumb { margin: 0; font-size: .83rem; }
        .breadcrumb-item a { color: var(--accent-dark); text-decoration: none; }
        .breadcrumb-item.active { color: var(--text-muted); }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 2.5rem; margin-bottom: .75rem; display: block; }
    </style>
    @stack('styles')
</head>

<body>
    {{-- ══ Navbar ══ --}}
    <nav class="public-navbar navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog.beranda') }}">
                <i class="bi bi-journal-richtext me-2"></i>Nusantara News
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.beranda') }}">
                            <i class="bi bi-house-door me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn-admin" href="{{ route('login') }}">
                            <i class="bi bi-shield-lock me-1"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ══ Hero Strip (only on beranda) ══ --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    {{-- ══ Breadcrumb ══ --}}
    @hasSection('breadcrumb')
        <div class="breadcrumb-bar">
            <div class="container">
                @yield('breadcrumb')
            </div>
        </div>
    @endif

    {{-- ══ Main Content ══ --}}
    <div class="main-wrapper">
        @yield('content')
    </div>

    {{-- ══ Footer ══ --}}
    <footer class="public-footer">
        <p class="mb-0">
            &copy; {{ date('Y') }} <strong>Nusantara News</strong> &mdash; Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> menggunakan Laravel 11 &amp; Bootstrap 5.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
