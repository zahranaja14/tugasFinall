<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $pesanan = Pesanan::with('user')->latest()->paginate(15);
        return view('admin.pesanan', compact('pesanan'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $pesanan->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    // Hapus pesanan
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return back()->with('success', 'Pesanan berhasil dihapus!');
    }

    // Reset semua pesanan
    public function reset()
    {
        Pesanan::truncate();
        return back()->with('success', 'Semua pesanan telah direset!');
    }
}
