@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-black mb-6">➕ Tambah Kategori</h1>

    <div class="bg-white/90 shadow-lg rounded-lg p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Masukkan nama kategori" required>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                Simpan
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="ml-3 bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg">
               Kembali
            </a>
        </form>
    </div>
</div>
@endsection
