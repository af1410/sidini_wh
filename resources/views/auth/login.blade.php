<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SIDINI</title>
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
</body>

</html>
