@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
<h1 class="text-3xl font-extrabold text-gray-900">Dashboard Admin</h1>
<p class="mt-1 text-lg text-gray-500 mb-8">Selamat datang kembali, Admin Toko. Berikut ringkasan performa toko Anda.</p>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

    {{-- Total Produk --}}
    <div class="bg-white overflow-hidden shadow-lg rounded-xl transition duration-300 hover:shadow-2xl hover:scale-[1.02] border-t-4 border-indigo-500">
        <div class="p-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 truncate">TOTAL PRODUK</p>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalProducts) }}</div>
            </div>
            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full text-indigo-600">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m-8-4v10l8 4m-8-4l8 4m-8-4v-10l8-4"></path></svg>
            </div>
        </div>
        <div class="px-5 py-3 bg-gray-50 text-sm">
            <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat Semua Produk &rarr;</a>
        </div>
    </div>

    {{-- Pesanan Baru --}}
    <div class="bg-white overflow-hidden shadow-lg rounded-xl transition duration-300 hover:shadow-2xl hover:scale-[1.02] border-t-4 border-yellow-500">
        <div class="p-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 truncate">PESANAN BARU</p>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($newOrdersCount) }}</div>
            </div>
            <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full text-yellow-600">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
        </div>
        <div class="px-5 py-3 bg-gray-50 text-sm">
            <a href="{{ route('admin.orders.index') }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Lihat Pesanan Pending &rarr;</a>
        </div>
    </div>

    {{-- Total Penjualan --}}
    <div class="bg-white overflow-hidden shadow-lg rounded-xl transition duration-300 hover:shadow-2xl hover:scale-[1.02] border-t-4 border-green-500">
        <div class="p-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 truncate">TOTAL PENJUALAN</p>
                <div class="mt-1 text-3xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full text-green-600">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6"></path></svg>
            </div>
        </div>
        <div class="px-5 py-3 bg-gray-50 text-sm">
            <a href="{{ route('admin.orders.index') }}" class="text-green-600 hover:text-green-900 font-medium">Laporan Penjualan &rarr;</a>
        </div>
    </div>

    {{-- Total Pengguna --}}
    <div class="bg-white overflow-hidden shadow-lg rounded-xl transition duration-300 hover:shadow-2xl hover:scale-[1.02] border-t-4 border-purple-500">
        <div class="p-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 truncate">TOTAL PENGGUNA</p>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalUsers) }}</div>
            </div>
            <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full text-purple-600">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
        <div class="px-5 py-3 bg-gray-50 text-sm">
            <a href="#" class="text-purple-600 hover:text-purple-900 font-medium">Kelola Pengguna &rarr;</a>
        </div>
    </div>
</div>

<!-- Tabel Pesanan Terbaru & Aktivitas -->
<div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- 5 Pesanan Terbaru --}}
    <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b pb-2">5 Pesanan Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($latestOrders as $order)
                    <tr>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name ?? 'Pengguna Tidak Ditemukan' }}</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm">
                            @php
                                $badgeClass = match(strtolower($order->status)) {
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'dikirim' => 'bg-blue-100 text-blue-800',
                                    'diproses' => 'bg-indigo-100 text-indigo-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                    default => 'bg-yellow-100 text-yellow-800', // Pending
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500">Belum ada pesanan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-right">
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">Lihat Semua Pesanan &rarr;</a>
        </div>
    </div>

    {{-- Aktivitas Terbaru & Link Cepat (Contoh) --}}
    <div class="lg:col-span-1 space-y-6">
        
        {{-- Aktivitas Terbaru --}}
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b pb-2">Aktivitas Terbaru</h2>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 mr-3 mt-1.5 rounded-full bg-blue-500 flex-shrink-0"></span>
                    Pelanggan baru **John Doe** mendaftar. <span class="text-xs ml-auto text-gray-400">5 menit lalu</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 mr-3 mt-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                    Produk **Kamera DSLR XYZ** diunggah. <span class="text-xs ml-auto text-gray-400">1 jam lalu</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 mr-3 mt-1.5 rounded-full bg-yellow-500 flex-shrink-0"></span>
                    Pesanan **#1005** statusnya Pending. <span class="text-xs ml-auto text-gray-400">2 jam lalu</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 mr-3 mt-1.5 rounded-full bg-indigo-500 flex-shrink-0"></span>
                    Kategori **Elektronik** diperbarui. <span class="text-xs ml-auto text-gray-400">Kemarin</span>
                </li>
            </ul>
        </div>

        {{-- Link Cepat --}}
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b pb-2">Link Cepat</h2>
            <div class="space-y-3">
                <a href="{{ route('admin.products.create') }}" class="flex items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-indigo-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="text-gray-800 font-medium">Tambah Produk Baru</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-purple-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10m0 0v10m0-10L7 17"></path></svg>
                    <span class="text-gray-800 font-medium">Kelola Kategori</span>
                </a>
            </div>
        </div>

    </div>
</div>


</div>
@endsection