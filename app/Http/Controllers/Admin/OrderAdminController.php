<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderAdminController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan (Admin Order Index).
     */
    public function index()
    {
        // Mengambil daftar pesanan dan mengurutkannya
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pesanan.
     */
    public function show(Order $order)
    {
        // Menampilkan view detail pesanan
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validasi status
        $request->validate(['status' => 'required|string|in:menunggu,diproses,dikirim,selesai,dibatalkan']);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui menjadi ' . $order->status . '.');
    }

    /**
     * Menghapus pesanan secara permanen dari penyimpanan.
     */
    public function destroy(Order $order)
    {
        // Validasi status (sesuai logika di index.blade.php): hanya boleh dihapus jika Selesai atau Dibatalkan
        $status = strtolower($order->status);
        if ($status !== 'selesai' && $status !== 'dibatalkan') {
            return redirect()->route('admin.orders.index')->with('error', 'Pesanan hanya dapat dihapus jika statusnya "Selesai" atau "Dibatalkan".');
        }

        try {
            // --- PENTING: Penanganan Relasi ---
            // Hapus item pesanan terkait terlebih dahulu untuk menghindari Foreign Key Constraint.
            // Asumsi: Model Order memiliki relasi 'items()'.
            if (method_exists($order, 'items')) {
                $order->items()->delete();
            }

            $order->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dihapus secara permanen.');
        } catch (\Exception $e) {
            // Catat error untuk debugging
            Log::error('Error deleting order #' . $order->id . ': ' . $e->getMessage());

            return redirect()->route('admin.orders.index')->with('error', 'Gagal menghapus pesanan #' . $order->id . ' karena kesalahan server.');
        }
    }
}
