<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus = Menu::where('tersedia', true)->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalPesanan = Pesanan::count();

        return view('admin.dashboard', compact('totalMenus', 'totalUsers', 'totalPesanan'));
    }
}