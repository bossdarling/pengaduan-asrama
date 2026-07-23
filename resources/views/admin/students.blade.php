<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Mahasiswa - Sistem Pengaduan Asrama</title>
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
        .students-container {
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
        .table-responsive {
            overflow-x: auto;
        }
        .students-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        .students-table th,
        .students-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        .students-table th {
            background: #f9fafb;
            font-weight: 600;
            color: #555;
        }
        .students-table tr:hover {
            background: #f9fafb;
        }
        .status-badge {
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-approved {
            background: #d1fae5;
            color: #059669;
        }
        .status-pending {
            background: #fef3c7;
            color: #d97706;
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
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
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
            .students-container {
                padding: 1.5rem;
            }
            h2 {
                font-size: 1.5rem;
            }
            .students-table th,
            .students-table td {
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
        <div class="students-container">
            <h2>👥 Kelola Mahasiswa</h2>
            
            @if ($students->isEmpty())
                <div class="empty-state">
                    <p>Belum ada mahasiswa yang mendaftar.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="students-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Asrama</th>
                                <th>Kamar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->nim }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->dorm_name }}</td>
                                    <td>{{ $student->room_number }}</td>
                                    <td>
                                        @if ($student->is_approved)
                                            <span class="status-badge status-approved">Disetujui</span>
                                        @else
                                            <span class="status-badge status-pending">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            @if (!$student->is_approved)
                                                <form method="POST" action="{{ route('admin.approve-student', $student->id) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Setujui mahasiswa ini?')">Setujui</button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.reject-student', $student->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak dan hapus mahasiswa ini?')">Tolak</button>
                                            </form>
                                        </div>
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
