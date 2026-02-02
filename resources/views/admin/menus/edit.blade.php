<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn-submit {
            padding: 12px 25px;
            background: #7A221E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-submit:hover {
            background: #5a1814;
        }
        .btn-cancel {
            padding: 12px 25px;
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }
        .current-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
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
        </nav>
    </div>
</header>

<div class="form-container">
    <h2 style="text-align: center; color: #7A221E; margin-bottom: 30px;">✏️ Edit Menu</h2>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_menu">Nama Menu *</label>
            <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
            @error('nama_menu')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="harga">Harga *</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" required>
            @error('harga')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kategori">Kategori *</label>
            <select id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="snack" {{ old('kategori', $menu->kategori) == 'snack' ? 'selected' : '' }}>Snack</option>
            </select>
            @error('kategori')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Baru (opsional)</label>
            @if($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="current-image">
                <p style="color: #666; font-size: 14px; margin-top: 10px;">Gambar saat ini. Upload gambar baru jika ingin mengganti.</p>
            @endif
            <input type="file" id="gambar" name="gambar" accept="image/*">
            @error('gambar')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center;">
                <input type="checkbox" name="tersedia" value="1" {{ old('tersedia', $menu->tersedia) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                Menu Tersedia
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn-submit">💾 Update Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

</body>
</html>