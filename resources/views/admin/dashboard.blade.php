<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 80px auto;
            padding: 30px;
        }
        .admin-header {
            text-align: center;
            margin-bottom: 40px;
            color: #7A221E;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            color: #7A221E;
            margin-bottom: 10px;
            font-size: 40px;
        }
        .stat-card p {
            color: #666;
            margin: 0;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .menu-btn {
            padding: 30px;
            background: #7A221E;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .menu-btn:hover {
            background: #5a1814;
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        .menu-btn-secondary {
            background: #6c757d;
        }
        .menu-btn-secondary:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud - Admin</strong></div>
        <nav>
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

<div class="admin-container">
    <h1 class="admin-header">🎛️ Dashboard Admin</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>{{ $totalPesanan }}</h3>
            <p>Total Pesanan</p>
        </div>
        <div class="stat-card">
            <h3>{{ $totalMenus }}</h3>
            <p>Menu Tersedia</p>
        </div>
        <div class="stat-card">
            <h3>{{ $totalUsers }}</h3>
            <p>Total User</p>
        </div>
    </div>

    <h2 style="margin-bottom: 20px; color: #7A221E;">⚙️ Menu Manajemen</h2>
    <div class="menu-grid">
        <a href="{{ route('admin.pesanan') }}" class="menu-btn">
            📦 Kelola Pesanan
        </a>
        <a href="{{ route('admin.menus.index') }}" class="menu-btn">
            🍹 Kelola Menu
        </a>
        <a href="{{ route('user.profile') }}" class="menu-btn menu-btn-secondary">
            👤 Profil Admin
        </a>
        <a href="{{ route('home') }}" class="menu-btn menu-btn-secondary">
            🏠 Kembali ke Home
        </a>
    </div>
</div>

</body>
</html>