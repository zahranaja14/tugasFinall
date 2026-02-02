<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud</strong></div>
        <nav>
            <a href="#home">Home</a>
            <a href="#tentang">Tentang</a>
            <a href="#menu">Menu</a>
            
            @auth
                <!-- Jika user sudah login -->
                @if(auth()->user()->role === 'admin')
                    <!-- Tombol Dashboard untuk Admin -->
                    <a href="{{ route('admin.dashboard') }}" class="btn-admin-login" style="background: #7A221E; color: white; padding: 5px 15px; border-radius: 5px; margin-left: 20px;">
                        Dashboard Admin
                    </a>
                @else
                    <!-- Tombol Pesanan untuk User biasa -->
                    <a href="{{ route('user.pesanan') }}" class="btn-admin-login" style="background: #7A221E; color: white; padding: 5px 15px; border-radius: 5px; margin-left: 20px;">
                        Pesanan Saya
                    </a>
                @endif
                
                <!-- Dropdown Akun User -->
                <div style="display: inline-block; position: relative; margin-left: 10px;">
                    <button onclick="toggleDropdown()" style="background: #5a1814; color: white; padding: 5px 15px; border-radius: 5px; border: none; cursor: pointer;">
                        👤 {{ auth()->user()->name }} ▼
                    </button>
                    <div id="userDropdown" style="display: none; position: absolute; right: 0; background: white; min-width: 150px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); border-radius: 5px; margin-top: 5px; z-index: 1000;">
                        <a href="{{ route('user.profile') }}" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">Profil</a>
                        <hr style="margin: 0; border: 0; border-top: 1px solid #eee;">
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="display: block; width: 100%; text-align: left; padding: 10px 15px; background: none; border: none; color: #dc3545; cursor: pointer;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Jika belum login -->
                <a href="{{ route('login') }}" class="btn-admin-login" style="background: #7A221E; color: white; padding: 5px 15px; border-radius: 5px; margin-left: 20px;">
                    Login
                </a>
            @endauth
        </nav>
    </div>
</header>

<section id="tentang" class="section tentang">
    <h2>Tentang Kedai Barmud</h2>
    <div style="background: white; border: 3px solid #7A221E; border-radius: 10px; padding: 25px; margin: 20px auto; max-width: 800px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <p>
            <strong>Kedai Barmud (Barudak Muda) hadir sebagai tempat nongkrong yang baik, sehat, 
                dan peduli terhadap kesehatan tubuh dalam diri kita.</strong>
        </p>
        <p>
           <strong> Kami hanya menggunakan susu murni berkualitas tinggi yang diproses
            secara higienis untuk memastikan kesegaran dan kandungan nutrisinya tetap terjaga.
            dengan berbagai varian rasa tanpa menghilangkan manfaat alaminya.</strong>
        </p>
    </div>
</section>

<section id="menu" class="section">
    <h1 class="title">Menu Susu Murni</h1>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 20px auto; max-width: 800px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <div class="menu">
        @forelse($items as $item)
            <div class="card">
                <h3>{{ $item['name'] }}</h3>
                <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <p style="color: #666; font-size: 14px; margin: 8px 0;">{{ $item['desc'] }}</p>
                <span class="price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>

                @auth
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produk" value="{{ $item['name'] }}">
                        <input type="hidden" name="harga" value="{{ $item['price'] }}">
                        <button class="btn">Pesan</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn" style="display: block; text-align: center; text-decoration: none; background: #dc3545; color: white;">
                        Login untuk Pesan
                    </a>
                @endauth
            </div>
        @empty
            <p style="text-align: center; color: #666; grid-column: 1 / -1;">Tidak ada menu tersedia saat ini.</p>
        @endforelse
    </div>
</section>

<footer>
    <div class="footer-bottom">
         Terimakasih telah mengunjungi Kedai Kami.
                                See you next time!
    </div>
</footer>

<script>
    // Toggle dropdown user menu
    function toggleDropdown() {
        var dropdown = document.getElementById("userDropdown");
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }

    // Close dropdown when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('button')) {
            var dropdown = document.getElementById("userDropdown");
            if (dropdown && dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    }
</script>

</body>
</html>