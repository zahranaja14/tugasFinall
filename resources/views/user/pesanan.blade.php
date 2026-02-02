<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .pesanan-container {
            max-width: 900px;
            margin: 80px auto;
            padding: 30px;
        }
        .pesanan-header {
            text-align: center;
            margin-bottom: 30px;
            color: #7A221E;
        }
        .pesanan-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-left: 5px solid #7A221E;
        }
        .pesanan-card h3 {
            color: #7A221E;
            margin-bottom: 15px;
        }
        .pesanan-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .pesanan-detail:last-child {
            border-bottom: none;
        }
        .status-badge {
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-diproses {
            background: #cce5ff;
            color: #004085;
        }
        .status-selesai {
            background: #d4edda;
            color: #155724;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            color: #999;
        }
        .btn-home {
            display: inline-block;
            padding: 10px 20px;
            background: #7A221E;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-home:hover {
            background: #5a1814;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud</strong></div>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('user.profile') }}">Profil</a>
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
    <h2 class="pesanan-header">🛒 Riwayat Pesanan Saya</h2>

    @if($pesanan->count() > 0)
        @foreach($pesanan as $index => $item)
            <div class="pesanan-card">
                <h3>Pesanan #{{ $loop->iteration }}</h3>
                <div class="pesanan-detail">
                    <span><strong>Produk:</strong></span>
                    <span>{{ $item->produk }}</span>
                </div>
                <div class="pesanan-detail">
                    <span><strong>Jumlah:</strong></span>
                    <span>{{ $item->jumlah }} cup</span>
                </div>
                <div class="pesanan-detail">
                    <span><strong>Total:</strong></span>
                    <span style="color: #7A221E; font-weight: bold;">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                </div>
                <div class="pesanan-detail">
                    <span><strong>Nama:</strong></span>
                    <span>{{ $item->nama }}</span>
                </div>
                <div class="pesanan-detail">
                    <span><strong>Waktu Pesan:</strong></span>
                    <span>{{ $item->created_at->format('d-m-Y H:i') }}</span>
                </div>
                <div class="pesanan-detail">
                    <span><strong>Status:</strong></span>
                    <span>
                        @if($item->status === 'pending')
                            <span class="status-badge status-pending">⏳ Menunggu</span>
                        @elseif($item->status === 'diproses')
                            <span class="status-badge status-diproses">🔄 Sedang Diproses</span>
                        @elseif($item->status === 'selesai')
                            <span class="status-badge status-selesai">✅ Selesai</span>
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-state">
            <h3>📦 Belum Ada Pesanan</h3>
            <p>Anda belum melakukan pesanan apapun.</p>
            <a href="{{ route('home') }}" class="btn-home">Mulai Pesan</a>
        </div>
    @endif
</div>

</body>
</html>