<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Kedai Barmud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <div class="logo">🥛 <strong>Kedai Barmud</strong></div>
        <nav>
            <a href="/">Home</a>
        </nav>
    </div>
</header>

<section class="section">
    <h1 class="title">Checkout</h1>

    <div class="card" style="max-width:500px;margin:auto">

        <p><strong>Produk:</strong> {{ $produk }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($harga,0,',','.') }}</p>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <input type="hidden" name="produk" value="{{ $produk }}">
            <input type="hidden" name="harga" value="{{ $harga }}">

            <input type="text" name="nama"
                   placeholder="Nama Pembeli"
                   required
                   style="width:100%;padding:10px;margin-bottom:15px">

            <input type="text" name="no_meja"
                   placeholder="Nomor Meja"
                   required
                   style="width:100%;padding:10px;margin-bottom:15px">

            <input type="number" name="jumlah"
                   placeholder="Jumlah"
                   value="1"
                   min="1"
                   required
                   style="width:100%;padding:10px;margin-bottom:20px">

            <button class="btn" style="width:100%">
                Checkout
            </button>
        </form>

    </div>
</section>


</body>
</html>
