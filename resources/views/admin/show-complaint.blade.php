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
        .photo-preview {
            max-width: 100%;
            border-radius: 12px;
            margin-top: 1rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
        }
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
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
        .actions {
            display: flex;
            gap: 1rem;
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
            .actions {
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
        <div class="detail-container">
            <h2>📄 Detail & Proses Pengaduan</h2>
            
            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <div class="detail-section">
                <div class="detail-label">Pelapor</div>
                <div class="detail-value">{{ $complaint->user->name }} ({{ $complaint->user->nim }})</div>
                <div class="detail-value" style="font-size: 0.9rem; color: #666;">
                    {{ $complaint->user->dorm_name }} - Kamar {{ $complaint->user->room_number }}
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Kategori</div>
                <div class="detail-value">{{ $complaint->category->name }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Status Saat Ini</div>
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
                    <div class="detail-label">Respon Admin Sebelumnya</div>
                    <div class="response-box">
                        <div class="detail-value">{{ $complaint->response }}</div>
                    </div>
                </div>
            @endif

            <hr style="margin: 2rem 0; border: none; border-top: 1px solid #e0e0e0;">

            <h3 style="margin-bottom: 1rem;">Update Status & Respon</h3>
            
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.update-complaint', $complaint->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="completed" {{ $complaint->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="response">Respon Admin</label>
                    <textarea id="response" name="response" placeholder="Tulis respon atau tindakan yang dilakukan...">{{ $complaint->response }}</textarea>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <a href="{{ route('admin.complaints') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
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
