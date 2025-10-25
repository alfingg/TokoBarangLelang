<!DOCTYPE html> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <head> <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1"> <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Toko Barang Lelang') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 min-h-screen">
    <div class="min-h-screen flex flex-col">

        <!-- 🌐 Navbar Biru -->
        <nav class="bg-blue-600 shadow-lg text-white sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- 🔹 Logo -->
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.tbl-removebg-preview.png') }}" alt="Logo" class="w-8 h-8">
                        <a href="{{ route('home') }}" class="text-lg font-semibold tracking-wide hover:text-blue-200 transition">
                            Toko Barang Lelang
                        </a>
                    </div>

                    <!-- 🔸 Menu Navigasi -->
                    <div class="flex items-center space-x-6 text-sm font-medium">
                        <a href="{{ route('home') }}" class="hover:text-blue-200 {{ request()->is('/') ? 'underline underline-offset-4' : '' }}">Produk</a>
                        <a href="{{ route('cart.index') }}" class="hover:text-blue-200 {{ request()->is('cart') ? 'underline underline-offset-4' : '' }}">Keranjang</a>
                        <a href="{{ route('orders.index') }}" class="hover:text-blue-200 {{ request()->is('orders*') ? 'underline underline-offset-4' : '' }}">Pesanan</a>
                    </div>

                    <!-- 🔹 Dropdown User -->
                    @auth
                        <div class="relative">
                            <button onclick="document.getElementById('dropdownUser').classList.toggle('hidden')" class="focus:outline-none hover:text-blue-200">
                                {{ Auth::user()->name }}
                                <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="dropdownUser" class="hidden absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg py-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- 🏷️ Header (Opsional) -->
        @hasSection('header')
            <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-blue-100">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- 📦 Konten Utama -->
        <main class="flex-grow py-10 px-4">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

        <!-- ⚓ Footer -->
        <footer class="mt-10 py-6 bg-blue-700 text-center text-white shadow-inner">
            <p class="text-sm">
                &copy; {{ date('Y') }} 
                <span class="font-semibold">Toko Barang Lelang</span>. 
                Semua Hak Dilindungi.
            </p>
        </footer>
    </div>

    <!-- JS Dropdown kecil -->
    <script>
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdownUser');
            if (!e.target.closest('#dropdownUser') && !e.target.closest('button')) {
                dropdown?.classList.add('hidden');
            }
        });
    </script>
</body>

</html>