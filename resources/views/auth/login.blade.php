<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SIDINI</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #29ab87;
            --secondary-color: #1e7f5f;
            --light-color: #f0f7f5;
            --text-color: #263238;
            --card-bg: rgba(255, 255, 255, 0.96);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text-color);
            background: radial-gradient(circle at top left, rgba(0, 200, 255, 0.18), transparent 25%),
                radial-gradient(circle at bottom right, rgba(74, 202, 237, 0.16), transparent 25%),
                linear-gradient(180deg, #eef9ff 0%, #f7fbff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .header-login {
            position: relative;
            height: 0;
            z-index: 10;
        }

        .login-container {
            position: relative;
            width: min(100%, 520px);
        }

        .login-shell {
            background: var(--card-bg);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(20, 40, 80, 0.12);
            border: 1px solid rgba(0, 200, 255, 0.12);
            margin-top: 45px;
        }

        .logo-wrapper {
            position: absolute;
            top: -30px;
            /* posisi turun */
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;

            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .logo-wrapper img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .login-brand {
            padding: 2.4rem 2rem 1.2rem;
            background: linear-gradient(140deg, var(--primary-color), var(--secondary-color));
            color: #ffffff;
            text-align: center;
        }

        .sidini {
            padding-top: 50px;
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            letter-spacing: -0.04em;
            font-weight: 700;
        }

        /* .login-body h1 {
            text-align: center;
            font-weight: 600;
            margin: -20px;

            letter-spacing: -0.04em;
        } */

        .login-body h1 {
            text-align: center;
            font-weight: 800;
            margin-top: -40px;
            font-size: 2.2rem;
            letter-spacing: -0.05em;
            color: #1f2d3d;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .login-body h1::after {
            content: "";
            display: block;
            width: 70px;
            height: 4px;
            margin: 10px auto 0;
            border-radius: 999px;
            background: linear-gradient(90deg, #29ab87, #1e7f5f);
            box-shadow: 0 4px 12px rgba(41, 171, 135, 0.35);
        }

        .login-brand h3 {
            margin-top: -10px;
            margin-bottom: 5px;
            opacity: 0.9;
            font-size: 1.25rem;
        }

        .login-body {
            padding: 2rem;
        }

        .login-body h2 {
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .login-body .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.15rem rgba(0, 200, 255, 0.18);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(120deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: #ffffff;
            padding: 0.95rem 1.2rem;
            font-weight: 600;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .btn-login:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .login-footer {
            margin-top: 1.25rem;
            text-align: center;
            color: #5a6b7c;
            font-size: 0.92rem;
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .login-footer a:hover {
            color: var(--secondary-color);
        }

        .form-check-label {
            user-select: none;
        }

        .invalid-feedback {
            display: block;
        }

        @media (max-width: 576px) {
            .login-shell {
                border-radius: 20px;
            }

            .login-brand {
                padding: 1.8rem 1.4rem 1rem;
            }

            .login-body {
                padding: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <div class="header-login">
            <div class="logo-wrapper">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="login-shell">
            <div class="login-brand">
                <h1 class="sidini">SIDINI</h1>
                <h3>Sistem Digitalisasi Nilai</h3>
            </div>
            <div class="login-body">
                <h1>Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>
            </div>
        </div>

        @if (session('error'))
            <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center px-4">
                            <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle mb-4" style="width:90px;height:90px;background:linear-gradient(140deg,#29ab87,#1e7f5f);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="white" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                                    <path d="M7.005 2.1a1 1 0 1 1 1.99 0l-.35 7a.645.645 0 0 1-1.29 0l-.35-7ZM8 12a1.25 1.25 0 1 0 0 2.5A1.25 1.25 0 0 0 8 12Z" />
                                </svg>
                            </div>
                            <h4 class="fw-bold mb-3">Login Gagal</h4>
                            <p class="text-muted mb-0">{{ session('error') }}</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center pt-0 pb-4">
                            <button type="button" class="btn btn-login px-5" data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = new bootstrap.Modal(document.getElementById('errorModal'));
                    modal.show();
                });
            </script>
        @endif
</body>

</html>
