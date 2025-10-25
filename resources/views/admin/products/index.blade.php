@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Produk</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ➕ Tambah Produk
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left">Gambar</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-right">Harga</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/60' }}" 
                                 class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-3 text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
