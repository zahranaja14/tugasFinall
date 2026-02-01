<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home', [
        'items' => [
            [
                'name' => 'Susu Murni Original',
                'price' => 8000,
                'desc' => 'Rasa asli, segar dan alami',
                'img'  => 'https://images.unsplash.com/photo-1580910051074-7b7d8c8f44c2'
            ],
            [
                'name' => 'Susu Murni Coklat',
                'price' => 10000,
                'desc' => 'Coklat premium manis legit',
                'img'  => 'https://images.unsplash.com/photo-1604908177522-0506e3f1c1c3'
            ],
            [
                'name' => 'Susu Murni Strawberry',
                'price' => 10000,
                'desc' => 'Segarnya buah strawberry',
                'img'  => 'https://images.unsplash.com/photo-1627998792088-f8016b4385e4'
            ],
            [
                'name' => 'Susu Murni Vanila',
                'price' => 10000,
                'desc' => 'Aroma vanila lembut',
                'img'  => 'https://images.unsplash.com/photo-1605475128023-8a59b1a1d6aa'
            ],
            [
                'name' => 'Susu Murni Melon',
                'price' => 10000,
                'desc' => 'Rasa melon menyegarkan',
                'img'  => 'https://images.unsplash.com/photo-1598514982840-8a5eafc13c0f'
            ],
        ]
    ]);
});

/*
|--------------------------------------------------------------------------
| CHECKOUT USER
|--------------------------------------------------------------------------
*/

/* tampil halaman checkout */
Route::post('/checkout', function (Request $request) {
    return view('checkout', [
        'produk' => $request->produk,
        'harga'  => $request->harga
    ]);
})->name('checkout');

/* proses checkout */
Route::post('/checkout/store', function (Request $request) {

    $pesanan = session()->get('pesanan', []);

    $total = $request->harga * $request->jumlah;

    $pesanan[] = [
        'nama'   => $request->nama,
        'alamat' => $request->alamat,
        'produk' => $request->produk,
        'jumlah' => $request->jumlah,
        'total'  => $total,
        'waktu'  => now()->format('d-m-Y H:i')
    ];

    session(['pesanan' => $pesanan]);

    return redirect()->route('checkout.success');

})->name('checkout.store');
    Route::get('/checkout/success', function () {
    return view('COsukses');
})->name('checkout.success');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/pesanan', function () {
    return view('admin.pesanan', [
        'pesanan' => session('pesanan', [])
    ]);
});

Route::post('/admin/reset', function () {
    session()->forget('pesanan');
    return back();
});
