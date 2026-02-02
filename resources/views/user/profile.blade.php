<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            color: #7A221E;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .profile-info .value {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            color: #555;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: #7A221E;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-back:hover {
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
            <a href="{{ route('user.pesanan') }}">Pesanan Saya</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; padding: 5px 15px; border-radius: 5px; border: none; cursor: pointer; margin-left: 10px;">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</header>

<div class="profile-container">
    <h2 class="profile-header">👤 Profil Saya</h2>

    <div class="profile-info">
        <label>Username:</label>
        <div class="value">{{ auth()->user()->name }}</div>
    </div>

    <div class="profile-info">
        <label>Email:</label>
        <div class="value">{{ auth()->user()->email }}</div>
    </div>

    <div class="profile-info">
        <label>Role:</label>
        <div class="value">
            @if(auth()->user()->role === 'admin')
                <span style="color: #7A221E; font-weight: bold;">Admin</span>
            @else
                <span style="color: #28a745; font-weight: bold;">User</span>
            @endif
        </div>
    </div>

    <div class="profile-info">
        <label>Bergabung Sejak:</label>
        <div class="value">{{ auth()->user()->created_at->format('d F Y') }}</div>
    </div>

    <a href="{{ route('home') }}" class="btn-back">← Kembali ke Home</a>
</div>

</body>
</html>