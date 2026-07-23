<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Pengaduan - Sistem Pengaduan Asrama</title>
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
        .complaints-container {
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
        .filter-group select, .filter-group input {
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
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
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
        .complaint-user {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        .complaint-date {
            color: #999;
            font-size: 0.85rem;
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
            .complaints-container {
                padding: 1.5rem;
            }
            h2 {
                font-size: 1.5rem;
            }
            .filters {
                flex-direction: column;
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
        <div class="complaints-container">
            <h2>📋 Kelola Pengaduan</h2>
            
            <form method="GET" action="{{ route('admin.complaints') }}">
                <div class="filters">
                    <div class="filter-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="category_id">Kategori</label>
                        <select id="category_id" name="category_id">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date_from">Dari Tanggal</label>
                        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="filter-group">
                        <label for="date_to">Sampai Tanggal</label>
                        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="filter-group" style="display: flex; align-items: flex-end;">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            
            @if ($complaints->isEmpty())
                <div class="empty-state">
                    <p>Tidak ada pengaduan yang ditemukan.</p>
                </div>
            @else
                <div class="complaint-list">
                    @foreach ($complaints as $complaint)
                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <div class="complaint-category">{{ $complaint->category->name }}</div>
                                    <div class="complaint-user">{{ $complaint->user->name }} - {{ $complaint->user->dorm_name }} (Kamar {{ $complaint->user->room_number }})</div>
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
                                <a href="{{ route('admin.show-complaint', $complaint->id) }}" class="btn btn-primary">Lihat Detail & Proses</a>
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
