<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CEKATAN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FFCB05;
            --text-color: #333;
            --bg-color: #f9fafb;
            --input-bg: #ffffff;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-container {
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            box-shadow: var(--shadow);
            background-color: white;
        }

        .register-image {
            flex: 1;
            background: linear-gradient(135deg, #ffcd053d 0%, #ffb300b8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: white;
            position: relative;
        }

        .register-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxsaW5lIHgxPSIwIiB5PSIwIiB4Mj0iMCIgeTI9IjQwIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMSIgc3Ryb2tlLW9wYWNpdHk9IjAuMiIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==') repeat;
            opacity: 0.5;
        }

        .register-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            position: relative;
            z-index: 10;
            text-align: center;
        }

        .logo-container img {
            max-width: 100%;
            height: auto;
        }

        .welcome-text {
            position: relative;
            z-index: 10;
            margin-top: 30px;
            text-align: center;
        }

        .welcome-text h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-text p {
            font-size: 16px;
            opacity: 0.9;
        }

        .form-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 26px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-header p {
            color: #666;
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            padding-left: 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: var(--input-bg);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 203, 5, 0.2);
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 42px;
            color: #999;
        }

        .register-button {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .register-button:hover {
            background-color: #FFB400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 203, 5, 0.4);
        }

        .login-link-container {
            text-align: center;
            margin-top: 10px;
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            font-size: 15px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: var(--error);
            font-size: 14px;
            margin-top: 5px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                height: auto;
            }

            .register-image {
                padding: 30px;
                min-height: 200px;
            }

            .register-form {
                padding: 30px;
            }

            .welcome-text {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-image">
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="CEKATAN Logo" width="200">
                <div class="welcome-text">
                    <h2>Selamat Datang</h2>
                    <p>Bergabung dengan CEKATAN untuk mengakses layanan kami</p>
                </div>
            </div>
        </div>

        <div class="register-form">
            <div class="form-header">
                <h1>Buat Akun Baru</h1>
                <p>Silakan isi data diri Anda untuk mendaftar</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <i class="fas fa-user"></i>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name" placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username" placeholder="Masukkan alamat email">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Masukkan password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <i class="fas fa-lock"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Masukkan kembali password">
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="register-button">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>

                <div class="login-link-container">
                    Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Masuk disini</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
