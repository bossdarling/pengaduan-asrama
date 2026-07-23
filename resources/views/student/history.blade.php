<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pengaduan - Sistem Pengaduan Asrama</title>
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
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            width: 100%;
        }
        .history-container {
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
        .complaint-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .complaint-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem;
            transition: box-shadow 0.3s;
        }
        .complaint-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .complaint-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .complaint-info {
            flex: 1;
            min-width: 200px;
        }
        .complaint-category {
            font-weight: 600;
            color: #667eea;
            font-size: 1rem;
        }
        .complaint-date {
            color: #999;
            font-size: 0.9rem;
        }
        .status-badge {
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
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
        .complaint-description {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        .complaint-actions {
            display: flex;
            gap: 1rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s;
            font-size: 0.9rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }
        .empty-state a {
            display: inline-block;
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
            .history-container {
                padding: 1.5rem;
            }
            h2 {
                font-size: 1.5rem;
            }
            .complaint-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .complaint-card {
                padding: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .navbar-brand h1 {
                font-size: 1.25rem;
            }
            .nav-links a {
                font-size: 0.85rem;
            }
            .complaint-actions {
                flex-direction: column;
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
        <div class="history-container">
            <h2>📋 Riwayat Pengaduan</h2>
            
            @if ($complaints->isEmpty())
                <div class="empty-state">
                    <p>Belum ada pengaduan yang dibuat.</p>
                    <a href="{{ route('student.create-complaint') }}" class="btn btn-primary">Buat Pengaduan Pertama</a>
                </div>
            @else
                <div class="complaint-list">
                    @foreach ($complaints as $complaint)
                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <div class="complaint-category">{{ $complaint->category->name }}</div>
                                    <div class="complaint-date">{{ $complaint->created_at->format('d M Y H:i') }}</div>
                                </div>
                                <span class="status-badge status-{{ $complaint->status }}">
                                    @if ($complaint->status == 'pending') Menunggu
                                    @elseif ($complaint->status == 'in_progress') Dalam Proses
                                    @else Selesai
                                    @endif
                                </span>
                            </div>
                            <div class="complaint-description">
                                {{ Str::limit($complaint->description, 150) }}
                            </div>
                            <div class="complaint-actions">
                                <a href="{{ route('student.show-complaint', $complaint->id) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
