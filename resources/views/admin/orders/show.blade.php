@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">

   <!-- Tombol Kembali -->
    <a href="{{ route('admin.orders.index') }}" 
        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md mb-6 shadow transition"> 
    ← Kembali ke Daftar Pesanan 
    </a>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
           🧾 Detail Pesanan #{{ $order->id }}
        </h1>
        <span class="px-3 py-1 text-sm rounded-full font-semibold 
            @class([
                'bg-yellow-100 text-yellow-800' => strtolower($order->status) === 'pending',
                'bg-sky-100 text-sky-800' => strtolower($order->status) === 'diproses',
                'bg-indigo-100 text-indigo-800' => strtolower($order->status) === 'dikirim',
                'bg-green-100 text-green-800' => strtolower($order->status) === 'selesai',
                'bg-red-100 text-red-800' => strtolower($order->status) === 'dibatalkan',
           ])">
             {{ ucfirst($order->status) }}
        </span>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
         <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
            Informasi Pelanggan
        </div>
        <div class="p-6 space-y-2 text-gray-700">
            <p><span class="font-semibold">Nama:</span> {{ $order->user->name ?? 'Tidak Diketahui' }}</p>
            <p><span class="font-semibold">Email:</span> {{ $order->user->email ?? '-' }}</p>
            <p><span class="font-semibold">Tanggal Pesan:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
            <p><span class="font-semibold">Total:</span> Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Daftar Item Pesanan -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 mt-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
            Barang Dipesan
        </div>
        <div class="p-6">
            {{-- KOREKSI: Menggunakan $order->items sesuai dengan controller --}}
            @if($order->items->isEmpty()) 
                <p class="text-gray-500 text-center py-4">Tidak ada item dalam pesanan ini.</p>
           @else
             <table class="w-full border-collapse text-sm text-gray-700">
                     <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left px-4 py-2">Produk</th>
                            <th class="text-center px-4 py-2">Jumlah</th>
                            <th class="text-right px-4 py-2">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- KOREKSI: Menggunakan $order->items --}}
                         @foreach($order->items as $item)
                         <tr class="border-b hover:bg-gray-50 transition">
                             <td class="px-4 py-2">{{ $item->product->name ?? 'Produk Dihapus' }}</td>
                             <td class="px-4 py-2 text-center">{{ $item->quantity }}</td>
                             <td class="px-4 py-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

            <!-- Ubah Status -->
             <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 mt-8">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
                    Ubah Status Pesanan
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3 sm:items-center">
                        @csrf
                        @method('PUT')
                        <select name="status" class="border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 w-full sm:w-auto">
                            @foreach(['pending','diproses','dikirim','selesai','dibatalkan'] as $status)
                            <option value="{{ $status }}" {{ strtolower($order->status) === $status ? 'selected' : '' }}>\
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

</div>
@endsection
