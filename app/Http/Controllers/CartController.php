<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan isi keranjang user login
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    // Menambahkan produk ke keranjang
    public function add(Product $product)
    {
        // Kalau belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login dulu untuk menambahkan ke keranjang.');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
