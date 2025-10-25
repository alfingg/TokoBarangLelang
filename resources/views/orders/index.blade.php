@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4"> <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">🛍️ Riwayat Pesanan Anda</h1>
@if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4 shadow-sm">
        {{ session('success') }}
    </div>
@endif

@if ($orders->isEmpty())
    <div class="bg-white p-8 rounded-lg shadow text-center">
        <p class="text-gray-600 mb-4">Belum ada pesanan yang Anda buat.</p>
        <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition">
            Belanja Sekarang
        </a>
    </div>
@else
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                    <th class="py-3 px-4 text-right">Total</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($orders as $order)
                    @php
                        $statusColor = match($order->status) {
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'processed' => 'bg-blue-100 text-blue-800',
                            'completed' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-semibold text-gray-700">#{{ $order->id }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-3 px-4 text-right font-medium text-gray-800">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="inline-block text-blue-600 hover:text-blue-800 font-medium transition">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-4 border-t bg-gray-50">
            {{ $orders->links() }}
        </div>
    </div>
@endif

</div> 
@endsection