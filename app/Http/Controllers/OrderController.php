<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /** List pesanan user */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /** Detail pesanan */
    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->load(['user', 'items.product']);
        return view('orders.show', compact('order'));
    }

    /** Form checkout */
    public function checkoutForm()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        return view('cart.checkout', compact('carts', 'user'));
    }

    /** Simpan order */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            abort(403, 'Admin tidak dapat melakukan pembelian.');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'Pending',
            'shipping_address' => $request->shipping_address,
        ]);

        foreach ($carts as $cart) {
            if ($cart->product) {
                $order->addItem($cart->product, $cart->quantity);
            }
        }

        Cart::where('user_id', $user->id)->delete();

        // Redirect ke WhatsApp admin
        $whatsapp = config('app.admin_phone', '6281234567890');
        $produkList = $carts->map(fn($c) => "{$c->product->name} (x{$c->quantity})")->join(', ');
        $message = urlencode("Halo Admin, saya {$user->name} telah melakukan checkout:\n\n📦 Barang: {$produkList}\n📍 Alamat: {$request->shipping_address}\n💰 Total: Rp {$order->totalFormatted}\n\nMohon konfirmasi pembayaran saya.");

        return redirect("https://wa.me/{$whatsapp}?text={$message}")
            ->with('success', 'Pesanan berhasil dibuat! Anda akan diarahkan ke WhatsApp admin.');
    }

    /** Quick order 1 produk */
    public function quickOrder(Product $product)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login.');
        }
        if ($user->role === 'admin') {
            abort(403, 'Admin tidak dapat melakukan pembelian.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'Pending',
            'shipping_address' => $user->address ?? 'Alamat belum diisi.',
        ]);

        $order->addItem($product, 1);

        $whatsapp = config('app.admin_phone', '6281234567890');
        $message = urlencode("Halo Admin, saya {$user->name} ingin membeli:\n\n🛍️ {$product->name}\n💰 Harga: Rp {$product->price}\n📍 Alamat: {$user->address}");

        return redirect("https://wa.me/{$whatsapp}?text={$message}")
            ->with('success', 'Pesanan berhasil dibuat! Anda akan diarahkan ke WhatsApp admin.');
    }
}
