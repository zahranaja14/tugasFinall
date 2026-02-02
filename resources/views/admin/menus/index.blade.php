<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Menu - Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .menus-container {
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
        .btn-add {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-add:hover {
            background: #218838;
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
        .btn-edit {
            padding: 5px 15px;
            background: #ffc107;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
        }
        .btn-delete {
            padding: 5px 15px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .badge-available {
            padding: 5px 10px;
            background: #28a745;
            color: white;
            border-radius: 5px;
            font-size: 12px;
        }
        .badge-unavailable {
            padding: 5px 10px;
            background: #dc3545;
            color: white;
            border-radius: 5px;
            font-size: 12px;
        }
        .success-alert {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud - Admin</strong></div>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.pesanan') }}">Pesanan</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; padding: 5px 15px; border-radius: 5px; border: none; cursor: pointer; margin-left: 10px;">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</header>

<div class="menus-container">
    <div class="header-section">
        <h2 style="color: #7A221E;">🍹 Manajemen Menu</h2>
        <a href="{{ route('admin.menus.create') }}" class="btn-add">+ Tambah Menu</a>
    </div>

    @if(session('success'))
        <div class="success-alert">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $index => $menu)
                <tr>
                    <td>{{ $menus->firstItem() + $index }}</td>
                    <td>
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                        @else
                            <span style="color: #999;">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $menu->nama_menu }}</strong></td>
                    <td>{{ ucfirst($menu->kategori) }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($menu->tersedia)
                            <span class="badge-available">Tersedia</span>
                        @else
                            <span class="badge-unavailable">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #999; padding: 40px;">
                        Belum ada menu. <a href="{{ route('admin.menus.create') }}">Tambah menu pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $menus->links() }}
        </div>
    </div>
</div>

</body>
</html>