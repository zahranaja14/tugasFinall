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
            <a href="/login" class="btn-admin-login" style="background: #7A221E; color: white; padding: 5px 15px; border-radius: 5px; margin-left: 20px;">Admin</a>
        </nav>
    </div>
</header>

<section id="tentang" class="section tentang">
    <h2>Tentang Kedai Barmud</h2>
    <p>
        <strong>Kedai Barmud (Barokah Mudah) hadir sebagai tempat nongkrong yang baik,sehat 
            dan peduli terhadap kesehatan tubuh dalam diri kita.</strong>
    </p>
    <p>
       <strong> Kami hanya menggunakan susu murni berkualitas tinggi yang diproses
        secara higienis untuk memastikan kesegaran dan kandungan nutrisinya tetap terjaga.
        dengan berbagai varian rasa tanpa menghilangkan manfaat alaminya.</strong>
    </p>
</section>

<section id="menu" class="section">
    <h1 class="title">Menu Susu Murni</h1>
    <div class="menu">

        <div class="card">
            <h3>Susu Murni Original</h3>
            <img src="{{ asset('image/ori.jpg') }}" alt="Susu Original" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
            <span class="price">Rp 8.000</span>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk" value="Susu Murni Original">
                <input type="hidden" name="harga" value="8000">
                <button class="btn">Pesan</button>
            </form>
        </div>

        <div class="card">
            <h3>Susu Murni Coklat</h3>
            <img src="{{ asset('image/coklat.jpg') }}" alt="Susu Coklat" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
            <span class="price">Rp 10.000</span>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk" value="Susu Murni Coklat">
                <input type="hidden" name="harga" value="10000">
                <button class="btn">Pesan</button>
            </form>
        </div>

        <div class="card">
            <h3>Susu Murni Stroberi</h3>
            <img src="{{ asset('image/stroberi.jpg') }}" alt="Susu Stroberi" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
            <span class="price">Rp 10.000</span>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk" value="Susu Murni Stroberi">
                <input type="hidden" name="harga" value="10000">
                <button class="btn">Pesan</button>
            </form>
        </div>

        <div class="card">
            <h3>Susu Murni Vanila</h3>
            <img src="{{ asset('image/vanila.jpg') }}" alt="Susu Vanila" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
            <span class="price">Rp 10.000</span>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk" value="Susu Murni Vanila">
                <input type="hidden" name="harga" value="10000">
                <button class="btn">Pesan</button>
            </form>
        </div>

        <div class="card">
            <h3>Susu Murni Melon</h3>
            <img src="{{ asset('image/melon.jpg') }}" alt="Susu Melon" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
            <span class="price">Rp 10.000</span>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk" value="Susu Murni Melon">
                <input type="hidden" name="harga" value="10000">
                <button class="btn">Pesan</button>
            </form>
        </div>

    </div>
</section>

<footer>
    <div class="footer-bottom">
         Terimakasih telah mengunjungi Kedai Kami
                                Seyou next time!
    </div>
</footer>

</body>
</html>