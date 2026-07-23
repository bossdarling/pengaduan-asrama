<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan Asrama - Universitas Daharmas Indonesia</title>
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
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            font-size: 1rem;
        }
        .btn-primary {
            background: white;
            color: #667eea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        /* Features Section */
        .features {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-title h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .section-title p {
            color: #666;
            font-size: 1.1rem;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .feature-card h3 {
            color: #333;
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
        }
        .feature-card p {
            color: #666;
            line-height: 1.6;
        }
        
        /* About Section */
        .about {
            background: white;
            padding: 5rem 2rem;
        }
        .about-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        .about-text h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }
        .about-text p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 12px;
        }
        .stat-item .number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }
        .stat-item .label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        
        /* How It Works Section */
        .how-it-works {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .step {
            text-align: center;
            padding: 2rem;
        }
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }
        .step h3 {
            color: #333;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }
        .step p {
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
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
        
        /* Responsive */
        @media (max-width: 1024px) {
            .about-content {
                grid-template-columns: 1fr;
            }
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
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .hero {
                padding: 4rem 1rem;
            }
            .features, .how-it-works {
                padding: 3rem 1rem;
            }
            .about {
                padding: 3rem 1rem;
            }
            .section-title h2 {
                font-size: 1.75rem;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .hero-buttons {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .navbar-brand h1 {
                font-size: 1.25rem;
            }
            .nav-links a {
                font-size: 0.85rem;
            }
            .hero h1 {
                font-size: 1.75rem;
            }
            .feature-icon {
                font-size: 2.5rem;
            }
            .about-stats {
                grid-template-columns: 1fr;
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
            <a href="#features">Fitur</a>
            <a href="#about">Tentang</a>
            <a href="#how-it-works">Cara Kerja</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Daftar</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Sistem Pengaduan Asrama</h1>
            <p>Universitas Daharmas Indonesia</p>
            <p style="font-size: 1rem; margin-top: 0.5rem;">Laporkan masalah asrama Anda dengan mudah, cepat, dan transparan</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Akun</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="features">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Sistem pengaduan asrama dengan berbagai fitur modern</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3>Buat Pengaduan</h3>
                    <p>Laporkan masalah di asrama dengan mudah melalui formulir online yang user-friendly</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Pantau Status</h3>
                    <p>Lacak status pengaduan Anda secara real-time dari dashboard pribadi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📸</div>
                    <h3>Upload Foto</h3>
                    <p>Lampirkan foto sebagai bukti untuk mempercepat proses penanganan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔔</div>
                    <h3>Notifikasi</h3>
                    <p>Dapatkan update status pengaduan langsung melalui sistem</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data Anda aman dengan sistem keamanan yang terjamin</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Responsive</h3>
                    <p>Akses sistem dari berbagai device dengan tampilan yang optimal</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about" id="about">
            <div class="about-content">
                <div class="about-text">
                    <h2>Tentang Sistem</h2>
                    <p>Sistem Pengaduan Asrama Universitas Daharmas Indonesia adalah platform digital yang dirancang untuk memudahkan mahasiswa dalam melaporkan berbagai masalah yang terjadi di lingkungan asrama.</p>
                    <p>Dengan sistem ini, mahasiswa dapat mengirimkan pengaduan dengan cepat, melacak status penanganan, dan mendapatkan respon dari pihak admin secara transparan.</p>
                    <p>Sistem ini bertujuan untuk meningkatkan kualitas layanan asrama dan memastikan setiap keluhan mahasiswa ditangani dengan baik dan tepat waktu.</p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="number">24/7</div>
                            <div class="label">Akses Kapan Saja</div>
                        </div>
                        <div class="stat-item">
                            <div class="number">⚡</div>
                            <div class="label">Respon Cepat</div>
                        </div>
                    </div>
                </div>
                <div class="about-image" style="text-align: center;">
                    <div style="font-size: 8rem; opacity: 0.1;">🏛️</div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works" id="how-it-works">
            <div class="section-title">
                <h2>Cara Kerja</h2>
                <p>Langkah mudah untuk melaporkan masalah asrama</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Daftar Akun</h3>
                    <p>Buat akun mahasiswa dengan data diri yang lengkap</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Tunggu Persetujuan</h3>
                    <p>Admin akan memverifikasi dan menyetujui akun Anda</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Buat Pengaduan</h3>
                    <p>Isi formulir pengaduan dengan detail masalah</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Pantau Status</h3>
                    <p>Lacak progress penanganan melalui dashboard</p>
                </div>
            </div>
        </section>
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
                <p><a href="#features">Fitur</a></p>
                <p><a href="#about">Tentang</a></p>
                <p><a href="#how-it-works">Cara Kerja</a></p>
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
