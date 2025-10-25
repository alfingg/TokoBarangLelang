@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Keranjang Belanja</h1>

    @if($carts->isEmpty())
        <div class="bg-white shadow rounded p-6 text-center">
            <p class="text-gray-600 mb-4">Keranjang Anda kosong.</p>
            <a href="{{ route('home') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
               Belanja Sekarang
            </a>
        </div>
    @else
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left">Produk</th>
                    <th class="p-3 text-center">Jumlah</th>
                    <th class="p-3 text-right">Harga</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($carts as $cart)
                    @php 
                        $subtotal = $cart->product->price * $cart->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $cart->product->name }}</td>
                        <td class="p-3 text-center">{{ $cart->quantity }}</td>
                        <td class="p-3 text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('cart.remove', $cart) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total & Tombol -->
        <div class="flex flex-col sm:flex-row justify-between items-center p-4 bg-gray-50 gap-4">
            <h2 class="text-xl font-semibold text-gray-800">
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </h2>

            <div class="flex space-x-3">
                <a href="{{ route('home') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">
                    ← Lanjut Belanja
                </a>

                <!-- Checkout Button -->
                <a href="{{ route('checkout.form') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Checkout Sekarang
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
