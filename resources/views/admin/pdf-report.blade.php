<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan Asrama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }
        .info p {
            margin: 5px 0;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .stat-box {
            text-align: center;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex: 1;
            margin: 0 5px;
        }
        .stat-box strong {
            display: block;
            font-size: 24px;
            color: #667eea;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background: #667eea;
            color: white;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
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
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENGADUAN ASRAMA</h1>
        <p>Universitas Daharmas Indonesia</p>
    </div>

    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ date('d M Y H:i') }}</p>
        @if ($date_from)
            <p><strong>Periode:</strong> {{ date('d M Y', strtotime($date_from)) }} - {{ $date_to ? date('d M Y', strtotime($date_to)) : 'Sekarang' }}</p>
        @else
            <p><strong>Periode:</strong> Semua Data</p>
        @endif
    </div>

    <div class="stats">
        <div class="stat-box">
            <strong>{{ $totalComplaints }}</strong>
            Total
        </div>
        <div class="stat-box">
            <strong>{{ $pendingComplaints }}</strong>
            Menunggu
        </div>
        <div class="stat-box">
            <strong>{{ $inProgressComplaints }}</strong>
            Dalam Proses
        </div>
        <div class="stat-box">
            <strong>{{ $completedComplaints }}</strong>
            Selesai
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelapor</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $index => $complaint)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $complaint->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $complaint->user->name }}<br><small>{{ $complaint->user->nim }}</small></td>
                    <td>{{ $complaint->category->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($complaint->description, 100) }}</td>
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

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis oleh Sistem Pengaduan Asrama</p>
        <p>&copy; {{ date('Y') }} Universitas Daharmas Indonesia</p>
    </div>
</body>
</html>
