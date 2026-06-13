<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Nusantara News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #2C3E50 0%, #1a2a3a 50%, #27AE60 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        /* Brand header */
        .brand-header {
            text-align: center;
            margin-bottom: 1.8rem;
        }
        .brand-header .brand-icon {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,.12);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: .9rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.15);
        }
        .brand-header .brand-icon i {
            font-size: 1.6rem;
            color: #fff;
        }
        .brand-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: #fff;
            margin-bottom: .3rem;
        }
        .brand-header p {
            font-size: .85rem;
            color: rgba(255,255,255,.6);
            margin: 0;
        }

        /* Card */
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            overflow: hidden;
        }

        .login-card .card-top {
            background: linear-gradient(135deg, #2C3E50, #27AE60);
            padding: 1.3rem 2rem;
            color: #fff;
        }
        .login-card .card-top h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: .15rem;
        }
        .login-card .card-top p {
            font-size: .78rem;
            opacity: .8;
            margin: 0;
        }

        .login-card .card-body {
            padding: 1.8rem 2rem 2rem;
        }

        /* Form elements */
        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: #555;
            letter-spacing: .03em;
        }
        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            padding: .65rem .9rem;
            font-size: .88rem;
            transition: border-color .25s, box-shadow .25s;
        }
        .form-control:focus {
            border-color: #27AE60;
            box-shadow: 0 0 0 3px rgba(39,174,96,.12);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1.5px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #888;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .input-group .form-control:focus {
            border-left: none;
        }
        .input-group:focus-within .input-group-text {
            border-color: #27AE60;
        }

        .btn-login {
            background: linear-gradient(135deg, #27AE60, #2ecc71);
            border: none;
            border-radius: 10px;
            padding: .7rem;
            font-size: .9rem;
            font-weight: 600;
            color: #fff;
            transition: transform .2s, box-shadow .2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39,174,96,.35);
            color: #fff;
        }
        .btn-login:active {
            transform: translateY(0);
        }

        /* Alert */
        .alert-danger {
            background-color: #fff0f0;
            border: 1px solid #f5c6c6;
            color: #c0392b;
            border-radius: 10px;
            font-size: .82rem;
        }

        /* Footer link */
        .login-footer {
            text-align: center;
            margin-top: 1.4rem;
        }
        .login-footer a {
            color: rgba(255,255,255,.6);
            font-size: .82rem;
            text-decoration: none;
            transition: color .2s;
        }
        .login-footer a:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        <!-- Brand -->
        <div class="brand-header">
            <div class="brand-icon">
                <i class="bi bi-journal-richtext"></i>
            </div>
            <h1>Nusantara News</h1>
            <p>Content Management System</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <div class="card-top">
                <h5><i class="bi bi-shield-lock me-2"></i>Login Admin</h5>
                <p>Masukkan kredensial untuk melanjutkan ke panel admin</p>
            </div>
            <div class="card-body">

                @if ($errors->has('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first('gagal') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_name" class="form-label">
                            <i class="bi bi-person me-1"></i>Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                value="{{ old('user_name') }}" placeholder="Masukkan username" autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-key me-1"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <a href="{{ route('blog.beranda') }}">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
