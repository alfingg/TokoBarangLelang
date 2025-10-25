@extends('layouts.app') 

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    {{-- Header Sesuai Struktur Asli (Ditingkatkan) --}}
    <h1 class="text-3xl font-extrabold mb-8 text-gray-800 border-b-4 border-blue-600 inline-block pb-2">
        Daftar Produk
    </h1>

    @if($products->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
            <p class="text-sm text-yellow-700">Belum ada produk tersedia.</p>
        </div>
    @else
        {{-- Grid Container (Ditingkatkan ke 4 kolom di layar besar) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            
            {{-- Kartu Produk (Desain Menarik & Interaktif) --}}
            <div class="bg-white rounded-xl overflow-hidden shadow-2xl shadow-gray-300/50 
                        hover:shadow-3xl hover:shadow-blue-300/60 hover:scale-[1.02] 
                        transition-all duration-300 ease-in-out transform border border-gray-100 group">

                {{-- Area Gambar --}}
                <div class="relative overflow-hidden h-48 sm:h-56">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/400x300/1E3A8A/FFFFFF?text=FOTO+PRODUK' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover rounded-t-xl transition duration-500 group-hover:opacity-90">
                </div>

                {{-- Konten Detail Produk --}}
                <div class="p-5 space-y-3">
                    
                    {{-- Nama Produk --}}
                    <h2 class="font-extrabold text-xl text-gray-800 hover:text-blue-600 transition truncate" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h2>
                    
                    {{-- Harga (Dibuat Lebih Menonjol) --}}
                    <div class="pt-1">
                        <span class="text-sm text-gray-500 block font-medium">Harga:</span>
                        <p class="text-3xl font-extrabold text-green-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Tombol Aksi (Tombol Penuh dan Berwarna) --}}
                    <div class="mt-4">
                        <a href="{{ route('product.show', $product->slug) }}" 
                            class="block w-full text-center bg-blue-600 text-white font-semibold py-2.5 rounded-lg 
                                   shadow-lg shadow-blue-500/50 hover:bg-blue-700 
                                   hover:translate-y-[-2px] hover:shadow-xl transition-all duration-200 ease-in-out">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
