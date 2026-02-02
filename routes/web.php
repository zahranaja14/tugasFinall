<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PesananController;

// ===== PUBLIC ROUTES =====
Route::get('/', function () {
    // Ambil menu dari database yang tersedia
    $menus = \App\Models\Menu::where('tersedia', true)->get();
    
    // Jika tidak ada menu di database, gunakan data default
    if ($menus->isEmpty()) {
        $items = [
            [
                'name' => 'Susu Murni Original',
                'price' => 8000,
                'desc' => 'Rasa asli, segar dan alami',
                'img'  => asset('image/ori.jpg')
            ],
            [
                'name' => 'Susu Murni Coklat',
                'price' => 10000,
                'desc' => 'Coklat premium manis legit',
                'img'  => asset('image/coklat.jpg')
            ],
            [
                'name' => 'Susu Murni Stroberi',
                'price' => 10000,
                'desc' => 'Segarnya buah strawberry',
                'img'  => asset('image/stroberi.jpg')
            ],
            [
                'name' => 'Susu Murni Vanila',
                'price' => 10000,
                'desc' => 'Aroma vanila lembut',
                'img'  => asset('image/vanila.jpg')
            ],
            [
                'name' => 'Susu Murni Melon',
                'price' => 10000,
                'desc' => 'Rasa melon menyegarkan',
                'img'  => asset('image/melon.jpg')
            ],
        ];
    } else {
        // Mapping nama menu ke gambar yang ada
        $imageMap = [
            'Susu Murni Original' => 'ori.jpg',
            'Susu Murni Coklat' => 'coklat.jpg',
            'Susu Murni Stroberi' => 'stroberi.jpg',
            'Susu Murni Vanila' => 'vanila.jpg',
            'Susu Murni Melon' => 'melon.jpg',
        ];

        // Mapping data dari database
        $items = $menus->map(function($menu) use ($imageMap) {
            $imageFile = $imageMap[$menu->nama_menu] ?? null;
            $imgPath = $imageFile ? asset('image/' . $imageFile) : asset('image/default.jpg');
            
            return [
                'name' => $menu->nama_menu,
                'price' => $menu->harga,
                'desc' => $menu->deskripsi ?? 'Menu lezat dari Kedai Barmud',
                'img' => $menu->gambar ? asset('storage/' . $menu->gambar) : $imgPath
            ];
        })->toArray();
    }
    
    return view('home', ['items' => $items]);
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// ===== AUTH ROUTES =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== USER ROUTES (Protected) =====
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', function (Request $request) {
        return view('checkout', [
            'produk' => $request->produk,
            'harga'  => $request->harga
        ]);
    })->name('checkout');

    Route::post('/checkout/store', function (Request $request) {
        $total = $request->harga * $request->jumlah;

        // Simpan ke database
        \App\Models\Pesanan::create([
            'user_id'        => auth()->id(),
            'nama'           => $request->nama,
            'produk'         => $request->produk,
            'jumlah'         => $request->jumlah,
            'harga_satuan'   => $request->harga,
            'total'          => $total,
            'status'         => 'pending',
        ]);

        // Tetap simpan ke session untuk backward compatibility
        $pesanan = session()->get('pesanan', []);
        $pesanan[] = [
            'nama'   => $request->nama,
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'total'  => $total,
            'waktu'  => now()->format('d-m-Y H:i'),
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name
        ];

        session(['pesanan' => $pesanan]);
        return redirect()->route('checkout.success');
    })->name('checkout.store');

    Route::get('/checkout/success', function () {
        return view('COsukses');
    })->name('checkout.success');

    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    Route::get('/user/pesanan', function () {
        $pesanan = \App\Models\Pesanan::where('user_id', auth()->id())->latest()->get();
        return view('user.pesanan', ['pesanan' => $pesanan]);
    })->name('user.pesanan');
});

// ===== ADMIN ROUTES (Protected) =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Menu
    Route::resource('menus', MenuController::class);
    
    // Kelola Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::patch('/pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::delete('/pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/reset', [PesananController::class, 'reset'])->name('reset');
});