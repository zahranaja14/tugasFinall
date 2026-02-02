<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .register-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            background: #7A221E;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-register:hover {
            background: #5a1814;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        .login-link a {
            color: #7A221E;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body style="background: white; min-height: 100vh;">

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud</strong></div>
        <nav>
            <a href="{{ route('home') }}">Home</a>
        </nav>
    </div>
</header>

<div class="register-container">
    <h2 style="text-align: center; color: #7A221E; margin-bottom: 30px;">Daftar Akun</h2>

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-register">Daftar</button>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </div>
</div>

</body>
</html>