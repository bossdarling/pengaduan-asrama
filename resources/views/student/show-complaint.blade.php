<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengaduan - Sistem Pengaduan Asrama</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            gap: 1.5rem;
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
        .main-content {
            flex: 1;
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            width: 100%;
        }
        .detail-container {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        h2 {
            color: #333;
            margin-bottom: 2rem;
            font-size: 1.75rem;
        }
        .detail-section {
            margin-bottom: 2rem;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
        }
        .detail-value {
            color: #333;
            line-height: 1.6;
        }
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }
        .status-in_progress {
            background: #dbeafe;
            color: #2563eb;
        }
        .status-completed {
            background: #d1fae5;
            color: #059669;
        }
        .response-box {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            font-size: 0.95rem;
        }
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .photo-preview {
            max-width: 100%;
            border-radius: 12px;
            margin-top: 1rem;
        }
        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: auto;
        }
        .footer p {
            margin-bottom: 0.5rem;
        }
        .footer small {
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
                padding: 0 1rem;
                margin: 1rem auto;
            }
            .detail-container {
                padding: 1.5rem;
            }
            h2 {
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
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <span style="font-size: 2rem;">🏛️</span>
            <h1>Sistem Pengaduan Asrama</h1>
        </div>
        <div class="nav-links">
            <a href="{{ route('student.dashboard') }}">Dashboard</a>
            <a href="{{ route('student.create-complaint') }}">Buat Pengaduan</a>
            <a href="{{ route('student.history') }}">Riwayat</a>
            <a href="#" onclick="document.getElementById('logout-form').submit();" style="color: white; text-decoration: none; font-weight: 500; font-size: 0.95rem;">Logout</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="detail-container">
            <h2>📄 Detail Pengaduan</h2>
            
            <div class="detail-section">
                <div class="detail-label">Kategori</div>
                <div class="detail-value">{{ $complaint->category->name }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Status</div>
                <span class="status-badge status-{{ $complaint->status }}">
                    @if ($complaint->status == 'pending') Menunggu
                    @elseif ($complaint->status == 'in_progress') Dalam Proses
                    @else Selesai
                    @endif
                </span>
            </div>

            <div class="detail-section">
                <div class="detail-label">Tanggal Dibuat</div>
                <div class="detail-value">{{ $complaint->created_at->format('d M Y H:i') }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Keterangan</div>
                <div class="detail-value">{{ $complaint->description }}</div>
            </div>

            @if ($complaint->photo)
                <div class="detail-section">
                    <div class="detail-label">Foto Bukti</div>
                    <img src="{{ asset('storage/' . $complaint->photo) }}" alt="Foto Bukti" class="photo-preview">
                </div>
            @endif

            @if ($complaint->response)
                <div class="detail-section">
                    <div class="detail-label">Respon Admin</div>
                    <div class="response-box">
                        <div class="detail-value">{{ $complaint->response }}</div>
                    </div>
                </div>
            @endif

            <a href="{{ route('student.history') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <footer class="footer">
        <p>© {{ date('Y') }} Universitas Daharmas Indonesia</p>
        <small>Sistem Pengaduan Asrama</small>
    </footer>

</body>
</html>
