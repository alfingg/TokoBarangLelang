<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Order;   
use App\Models\User;    

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama admin dengan data statistik.
     */
    public function index()
    {
        // 1. Ambil Total Produk
        $totalProducts = Product::count();
        
        // 2. Ambil Total Pengguna (asumsi admin tidak dihitung, atau role='buyer'/'user')
        $totalUsers = User::where('role', '!=', 'admin')->count(); 
        
        // 3. Ambil Pesanan Baru (asumsi status 'pending')
        $newOrdersCount = Order::where('status', 'pending')->count();
        
        // 4. Ambil Total Penjualan (Revenue), dari pesanan yang statusnya 'selesai'
        // KOREKSI: Mengubah 'total_price' menjadi 'total'
        $totalRevenue = Order::where('status', 'selesai')->sum('total'); 
        
        // 5. Ambil 5 Pesanan Terbaru untuk tabel
        $latestOrders = Order::with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalUsers', 
            'newOrdersCount', 
            'totalRevenue', 
            'latestOrders'
        ));
    }
}
