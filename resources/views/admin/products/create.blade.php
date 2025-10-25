@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Harga</label>
                <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">
                    ← Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
