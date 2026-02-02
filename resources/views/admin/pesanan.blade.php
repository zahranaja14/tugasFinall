<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .pesanan-container {
            max-width: 1200px;
            margin: 80px auto;
            padding: 30px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn-reset {
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-reset:hover {
            background: #c82333;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th {
            background: #7A221E;
            color: white;
            padding: 12px;
            text-align: left;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table tr:hover {
            background: #f8f9fa;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        .success-alert {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .badge-user {
            padding: 5px 10px;
            background: #17a2b8;
            color: white;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud - Admin</strong></div>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.menus.index') }}">Kelola Menu</a>
            <a href="{{ route('home') }}">Lihat Website</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; padding: 5px 15px; border-radius: 5px; border: none; cursor: pointer; margin-left: 10px;">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</header>

<div class="pesanan-container">
    <div class="header-section">
        <h2 style="color: #7A221E;">📦 Kelola Pesanan</h2>
        
        @if($pesanan->count() > 0)
            <form action="{{ route('admin.reset') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua pesanan?')" style="display: inline;">
                @csrf
                @method('POST')
                <button type="submit" class="btn-reset">🗑️ Reset Semua Pesanan</button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="success-alert">{{ session('success') }}</div>
    @endif

    @if($pesanan->count() > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Nama Pemesan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan as $index => $item)
                    <tr>
                        <td>{{ ($pesanan->currentPage() - 1) * $pesanan->perPage() + $loop->iteration }}</td>
                        <td>
                            <span class="badge-user">
                                {{ $item->user->name }}
                            </span>
                        </td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ $item->produk }}</td>
                        <td>{{ $item->jumlah }} cup</td>
                        <td style="color: #7A221E; font-weight: bold;">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </td>
                        <td>
                            <form action="{{ route('admin.pesanan.updateStatus', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 3px; border: 1px solid #ddd;">
                                    <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ $item->status === 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size: 14px; color: #666;">
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td>
                            <form action="{{ route('admin.pesanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div style="margin-top: 20px; text-align: center;">
                {{ $pesanan->links() }}
            </div>
        </div>
    @else
        <div class="table-container">
            <div class="empty-state">
                <h3>📭 Belum Ada Pesanan</h3>
                <p>Tidak ada pesanan yang masuk saat ini.</p>
                <a href="{{ route('admin.dashboard') }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #7A221E; color: white; text-decoration: none; border-radius: 5px;">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    @endif
</div>

</body>
</html>