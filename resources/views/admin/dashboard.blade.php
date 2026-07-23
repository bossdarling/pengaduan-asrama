<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Sistem Pengaduan Asrama</title>
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
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            width: 100%;
        }
        .welcome-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .welcome-section h2 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
        }
        .welcome-section p {
            color: #666;
            margin-bottom: 1.5rem;
        }
        .date-info {
            display: flex;
            gap: 2rem;
            color: #888;
            font-size: 0.9rem;
        }
        .date-info span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.75rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .stat-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .stat-card h3 {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }
        .stat-card .trend {
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        .stat-card .trend.up {
            color: #10b981;
        }
        .stat-card .trend.down {
            color: #ef4444;
        }
        .stat-card.primary .stat-card-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card.primary .number { color: #667eea; }
        .stat-card.warning .stat-card-icon { background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); }
        .stat-card.warning .number { color: #f59e0b; }
        .stat-card.info .stat-card-icon { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .stat-card.info .number { color: #3b82f6; }
        .stat-card.success .stat-card-icon { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .stat-card.success .number { color: #10b981; }
        .stat-card.danger .stat-card-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .stat-card.danger .number { color: #ef4444; }
        .stat-card.purple .stat-card-icon { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
        .stat-card.purple .number { color: #8b5cf6; }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        .card {
            background: white;
            padding: 1.75rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .card h3 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .recent-complaints {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .complaint-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 12px;
            transition: background 0.3s;
        }
        .complaint-item:hover {
            background: #f0f2f5;
        }
        .complaint-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .complaint-info {
            flex: 1;
        }
        .complaint-info h4 {
            color: #333;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }
        .complaint-info p {
            color: #666;
            font-size: 0.85rem;
        }
        .complaint-status {
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .complaint-status.pending {
            background: #fef3c7;
            color: #d97706;
        }
        .complaint-status.in_progress {
            background: #dbeafe;
            color: #2563eb;
        }
        .complaint-status.completed {
            background: #d1fae5;
            color: #059669;
        }
        .category-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 12px;
        }
        .category-name {
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .category-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .btn {
            padding: 0.85rem 1.75rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            font-size: 0.95rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
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
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #999;
            font-size: 0.9rem;
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
        
        @media (max-width: 1024px) {
            .dashboard-grid {
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
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }
            .stat-card {
                padding: 1.25rem;
            }
            .stat-card .number {
                font-size: 2rem;
            }
            .date-info {
                flex-direction: column;
                gap: 0.5rem;
            }
            .main-content {
                padding: 0 1rem;
                margin: 1rem auto;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .navbar-brand h1 {
                font-size: 1.25rem;
            }
            .nav-links a {
                font-size: 0.85rem;
            }
            .actions {
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
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.complaints') }}">Pengaduan</a>
            <a href="{{ route('admin.students') }}">Mahasiswa</a>
            <a href="{{ route('admin.reports') }}">Laporan</a>
            <a href="#" onclick="document.getElementById('logout-form').submit();" style="color: white; text-decoration: none; font-weight: 500; font-size: 0.95rem;">Logout</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="welcome-section">
            <h2>Selamat Datang, Admin! 👋</h2>
            <p>Kelola sistem pengaduan asrama dengan mudah dan efisien</p>
            <div class="date-info">
                <span>📅 {{ now()->format('d F Y') }}</span>
                <span>🕐 {{ now()->format('H:i') }}</span>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-card-header">
                    <div class="stat-card-icon">📊</div>
                </div>
                <h3>Total Pengaduan</h3>
                <div class="number">{{ $totalComplaints }}</div>
                <div class="trend up">↑ Semua waktu</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-card-header">
                    <div class="stat-card-icon">⏳</div>
                </div>
                <h3>Menunggu</h3>
                <div class="number">{{ $pendingComplaints }}</div>
                <div class="trend">Perlu tindakan</div>
            </div>
            <div class="stat-card info">
                <div class="stat-card-header">
                    <div class="stat-card-icon">🔄</div>
                </div>
                <h3>Dalam Proses</h3>
                <div class="number">{{ $inProgressComplaints }}</div>
                <div class="trend">Sedang dikerjakan</div>
            </div>
            <div class="stat-card success">
                <div class="stat-card-header">
                    <div class="stat-card-icon">✅</div>
                </div>
                <h3>Selesai</h3>
                <div class="number">{{ $completedComplaints }}</div>
                <div class="trend up">↑ {{ $totalComplaints > 0 ? round(($completedComplaints / $totalComplaints) * 100, 1) : 0 }}% selesai</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-card-header">
                    <div class="stat-card-icon">👥</div>
                </div>
                <h3>Total Mahasiswa</h3>
                <div class="number">{{ $totalStudents }}</div>
                <div class="trend">{{ $approvedStudents }} aktif</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-card-header">
                    <div class="stat-card-icon">🔔</div>
                </div>
                <h3>Menunggu Persetujuan</h3>
                <div class="number">{{ $pendingStudents }}</div>
                <div class="trend {{ $pendingStudents > 0 ? 'up' : 'down' }}">
                    {{ $pendingStudents > 0 ? 'Perlu persetujuan' : 'Tidak ada antrian' }}
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>📋 Pengaduan Terbaru</h3>
                <div class="recent-complaints">
                    @if ($recentComplaints->isEmpty())
                        <div class="empty-state">Belum ada pengaduan</div>
                    @else
                        @foreach ($recentComplaints as $complaint)
                            <div class="complaint-item">
                                <div class="complaint-icon">📝</div>
                                <div class="complaint-info">
                                    <h4>{{ $complaint->category->name }}</h4>
                                    <p>{{ $complaint->user->name }} • {{ $complaint->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="complaint-status {{ $complaint->status }}">
                                    @if ($complaint->status == 'pending') Menunggu
                                    @elseif ($complaint->status == 'in_progress') Proses
                                    @else Selesai
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="card">
                <h3>📊 Pengaduan per Kategori</h3>
                <div class="category-list">
                    @if ($complaintsByCategory->isEmpty())
                        <div class="empty-state">Belum ada data</div>
                    @else
                        @foreach ($complaintsByCategory as $item)
                            <div class="category-item">
                                <span class="category-name">{{ $item->category->name }}</span>
                                <span class="category-count">{{ $item->count }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('admin.complaints') }}" class="btn btn-primary">Kelola Pengaduan</a>
            <a href="{{ route('admin.students') }}" class="btn btn-primary">Kelola Mahasiswa</a>
            <a href="{{ route('admin.reports') }}" class="btn btn-secondary">Buat Laporan</a>
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
