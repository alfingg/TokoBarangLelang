<x-guest-layout>
<!-- Kontainer Utama: Fokus dan Terpusat -->
<!-- Diubah: bg-white dihapus, diganti dengan gradasi biru. text-white ditambahkan untuk kontras. -->
<div class="w-full max-w-sm mx-auto my-12 md:my-20 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl shadow-2xl shadow-indigo-100/50 overflow-hidden text-white">

    <!-- Kolom Gambar di Bagian Atas Card (Header Biru Polos) -->
    <!-- Warna Header diubah menjadi to-blue-700 agar sedikit lebih gelap dari gradasi utama -->
    <div class="h-16 bg-blue-700">
        <!-- Dibuat lebih pendek, hanya sebagai latar belakang warna -->
    </div>
    
    <!-- Logo Toko Bulat yang Diletakkan di Tengah -->
    <div class="mt-[-40px] mb-6 flex justify-center">
        <!-- mt-[-40px] untuk menaikkan logo agar sedikit 'overlap' dengan header di atas -->
        <!-- Placeholder Logo Toko (Ganti URL ini dengan logo Anda) -->
        <!-- Border diubah menjadi border-blue-700 agar menyatu dengan warna header card -->
                <img src="{{ asset('images/logo.tbl-removebg-preview.png') }}" 
             alt="Logo Toko" 
             class="w-20 h-20 rounded-full border-4 border-blue-700 shadow-lg object-cover">
    </div>

    <!-- Konten Form Utama (diberi padding di sini) -->
    <div class="p-8 sm:p-10 pt-0">
        <!-- Padding top dihilangkan karena logo sudah memberi jarak, dan diatur menjadi pt-0 -->

        <!-- Logo atau Nama Aplikasi (Tambahan Estetika) -->
        <div class="flex flex-col items-center justify-center mb-6">
            <!-- Warna teks sudah diwarisi dari kontainer utama (text-white) -->
            <h2 class="text-2xl font-extrabold">Buat Akun</h2>
            <p class="text-sm text-indigo-100 mt-1">Daftarkan diri Anda untuk memulai.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama')" class="text-white" />
                <!-- Input background diubah ke white, dan border/focus ring diubah ke warna biru yang lebih gelap (indigo) -->
                <x-text-input id="name" class="block mt-1 w-full bg-white text-gray-800 border-gray-300 focus:border-indigo-800 focus:ring-indigo-800 rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full bg-white text-gray-800 border-gray-300 focus:border-indigo-800 focus:ring-indigo-800 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />

                <x-text-input id="password" class="block mt-1 w-full bg-white text-gray-800 border-gray-300 focus:border-indigo-800 focus:ring-indigo-800 rounded-lg shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-white" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-white text-gray-800 border-gray-300 focus:border-indigo-800 focus:ring-indigo-800 rounded-lg shadow-sm"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <!-- Tautan diubah menjadi warna kontras (white/indigo-100) -->
                <a class="underline text-indigo-100 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Sudah terdaftar?') }}
                </a>

                <!-- Tombol REGISTER diubah menjadi warna yang lebih cerah (mis. hijau) agar menonjol dari gradasi biru -->
                <x-primary-button class="ms-3 bg-green-500 hover:bg-green-600 focus:ring-green-400 rounded-lg py-2 px-6 shadow-md transition duration-150 ease-in-out font-bold">
                    {{ __('REGISTER') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</div>


</x-guest-layout>