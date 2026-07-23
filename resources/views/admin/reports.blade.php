<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan - Sistem Pengaduan Asrama</title>
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
        .reports-container {
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
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        .filter-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        .filter-group input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.95rem;
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
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }
        .stat-card h3 {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }
        .stat-card.pending .number { color: #f59e0b; }
        .stat-card.in-progress .number { color: #3b82f6; }
        .stat-card.completed .number { color: #10b981; }
        .table-responsive {
            overflow-x: auto;
        }
        .reports-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        .reports-table th,
        .reports-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        .reports-table th {
            background: #f9fafb;
            font-weight: 600;
            color: #555;
        }
        .reports-table tr:hover {
            background: #f9fafb;
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
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
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
            .reports-container {
                padding: 1.5rem;
            }
            h2 {
                font-size: 1.5rem;
            }
            .filters {
                flex-direction: column;
            }
            .reports-table th,
            .reports-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 480px) {
            .navbar-brand h1 {
                font-size: 1.25rem;
            }
            .nav-links a {
                font-size: 0.85rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <span style="font-size: 2rem;">🏛️</span>
            <h1>Sistem Pengaduan Asrama - Admin</h1>
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
        <div class="reports-container">
            <h2>📊 Laporan Pengaduan</h2>
            
            <form method="GET" action="{{ route('admin.reports') }}">
                <div class="filters">
                    <div class="filter-group">
                        <label for="date_from">Dari Tanggal</label>
                        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="filter-group">
                        <label for="date_to">Sampai Tanggal</label>
                        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="filter-group" style="display: flex; align-items: flex-end; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.generate-pdf', request()->query()) }}" class="btn btn-success">Download PDF</a>
                    </div>
                </div>
            </form>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Pengaduan</h3>
                    <div class="number">{{ $totalComplaints }}</div>
                </div>
                <div class="stat-card pending">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $pendingComplaints }}</div>
                </div>
                <div class="stat-card in-progress">
                    <h3>Dalam Proses</h3>
                    <div class="number">{{ $inProgressComplaints }}</div>
                </div>
                <div class="stat-card completed">
                    <h3>Selesai</h3>
                    <div class="number">{{ $completedComplaints }}</div>
                </div>
            </div>
            
            @if ($complaints->isEmpty())
                <div class="empty-state">
                    <p>Tidak ada data pengaduan dalam periode yang dipilih.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="reports-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $complaint->user->name }}<br><small>{{ $complaint->user->nim }}</small></td>
                                    <td>{{ $complaint->category->name }}</td>
                                    <td>{{ Str::limit($complaint->description, 100) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $complaint->status }}">
                                            @if ($complaint->status == 'pending') Menunggu
                                            @elseif ($complaint->status == 'in_progress') Dalam Proses
                                            @else Selesai
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
