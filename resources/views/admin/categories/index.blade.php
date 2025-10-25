@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-black mb-6">📂 Daftar Kategori</h1>

    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Kategori Produk</h2>
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah Kategori
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 border-b">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nama Kategori</th>
                    <th class="py-3 px-4 text-left">Slug</th>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b hover:bg-blue-50/50 transition">
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 font-medium">{{ $category->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $category->slug }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $category->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4 text-center flex justify-center space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
