<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CEKATAN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FFCB05;
            --text-color: #333;
            --bg-color: #f9fafb;
            --input-bg: #ffffff;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            --error: #ef4444;
            --success: #10b981;
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

        .reset-container {
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            height: 500px;
            box-shadow: var(--shadow);
            background-color: white;
        }

        .reset-image {
            flex: 1;
            background: linear-gradient(135deg, #ffcd053d 0%, #ffb300b8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: white;
            position: relative;
        }

        .reset-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxsaW5lIHgxPSIwIiB5PSIwIiB4Mj0iMCIgeTI9IjQwIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMSIgc3Ryb2tlLW9wYWNpdHk9IjAuMiIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==') repeat;
            opacity: 0.5;
        }

        .reset-form {
            flex: 1;
            padding: 50px;
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

        .icon-container {
            position: relative;
            z-index: 10;
            margin-top: 40px;
            text-align: center;
        }

        .icon-container i {
            font-size: 60px;
            color: white;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 26px;
            color: var(--text-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .form-description {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 25px;
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

        .reset-button {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .reset-button:hover {
            background-color: #FFB400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 203, 5, 0.4);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .back-link a:hover {
            color: var(--primary-color);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .error-message {
            color: var(--error);
            font-size: 14px;
            margin-top: 5px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .reset-container {
                flex-direction: column;
                height: auto;
            }

            .reset-image {
                padding: 30px;
                min-height: 200px;
            }

            .reset-form {
                padding: 30px;
            }

            .icon-container {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <div class="reset-image">
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="CEKATAN Logo" width="200">
                <div class="icon-container">
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>

        <div class="reset-form">
            <div class="form-header">
                <h1>Reset Password</h1>
            </div>

            <p class="form-description">
                Lupa password Anda? Tidak masalah. Cukup masukkan alamat email Anda, dan kami akan mengirimkan link
                reset password untuk memilih password baru.
            </p>

            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="Masukkan alamat email anda">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="reset-button">
                    <i class="fas fa-paper-plane"></i> Kirim Link Reset Password
                </button>

                <div class="back-link">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Kembali ke halaman login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
