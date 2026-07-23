<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Pengaduan Asrama</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .navbar-brand h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
            font-size: 0.95rem;
        }
        .nav-links a:hover {
            opacity: 0.8;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-container {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        }
        .register-link {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        .success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .footer-section h3 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        .footer-section p {
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }
        .footer-section a {
            color: white;
            text-decoration: none;
            opacity: 0.9;
            transition: opacity 0.3s;
        }
        .footer-section a:hover {
            opacity: 1;
        }
        .footer-bottom {
            max-width: 1200px;
            margin: 2rem auto 0;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            .main-content {
                padding: 1rem;
            }
            .login-container {
                padding: 2rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .navbar-brand h1 {
                font-size: 1.25rem;
            }
            .nav-links a {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span style="font-size: 2rem;">🏛️</span>
            <h1>Sistem Pengaduan Asrama</h1>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('register') }}">Daftar</a>
            <a href="{{ route('login') }}" style="opacity: 1; font-weight: 600;">Login</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="login-container">
            <h1>🔐 Login</h1>
            
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            
            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>🏛️ Sistem Pengaduan Asrama</h3>
                <p>Platform pengaduan asrama modern untuk Universitas Daharmas Indonesia</p>
            </div>
            <div class="footer-section">
                <h3>Navigasi</h3>
                <p><a href="{{ route('home') }}#features">Fitur</a></p>
                <p><a href="{{ route('home') }}#about">Tentang</a></p>
                <p><a href="{{ route('home') }}#how-it-works">Cara Kerja</a></p>
            </div>
            <div class="footer-section">
                <h3>Akun</h3>
                <p><a href="{{ route('login') }}">Login</a></p>
                <p><a href="{{ route('register') }}">Daftar</a></p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>📧 admin@udh.ac.id</p>
                <p>📞 +62 xxx xxxx xxxx</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Universitas Daharmas Indonesia. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
