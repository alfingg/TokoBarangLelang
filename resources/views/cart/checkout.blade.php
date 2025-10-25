@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <!-- Alamat Pengiriman -->
        <div class="mb-4">
            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
            <textarea name="shipping_address" id="shipping_address" rows="4" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Masukkan alamat lengkap">{{ old('shipping_address') }}</textarea>
            @error('shipping_address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ringkasan Keranjang -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Ringkasan Pesanan</h2>
            <ul class="divide-y divide-gray-200">
                @php $cartTotal = 0; @endphp
                @foreach($carts as $cart)
                    @php $subtotal = $cart->product->price * $cart->quantity; @endphp
                    @php $cartTotal += $subtotal; @endphp
                    <li class="py-2 flex justify-between">
                        <span>{{ $cart->product->name }} x {{ $cart->quantity }}</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-2 flex justify-between font-bold">
                <span>Total</span>
                <span>Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">
            Pesan Sekarang
        </button>
    </form>
</div>
@endsection
