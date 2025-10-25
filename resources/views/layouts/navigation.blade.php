<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- =============== Logo / Brand (PERBAIKAN DI SINI) =============== -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    {{-- Ganti <x-application-logo /> dengan tag <img> --}}
                    <img src="{{ asset('images/logo-tbl.jpg') }}" 
                         alt="Logo Toko Barang Lelang" 
                         class="h-8 w-auto rounded-md shadow-sm"> 

                    <span class="ml-2 font-bold text-xl text-gray-800">Toko Barang Lelang</span>
                </a>
            </div>

            <!-- =============== Main Menu =============== -->
            <div class="hidden sm:flex space-x-8 items-center">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    Produk
                </x-nav-link>

                @auth
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        Keranjang
                    </x-nav-link>

                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        Pesanan
                    </x-nav-link>

                    {{-- ================== ADMIN MENU ================== --}}
                    @if(Auth::user()->role === 'admin')
                        <div x-data="{ openAdmin: false }" class="relative">
                            <button @click="openAdmin = ! openAdmin"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md 
                                            text-gray-700 hover:text-blue-600 transition">
                                Admin Panel
                                <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" 
                                            viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 
                                                0 111.06 1.061l-4.24 4.24a.75.75 0 01-1.06 0l-4-4a.75.75 
                                                0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="openAdmin" @click.away="openAdmin = false"
                                class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 
                                            rounded-lg shadow-lg z-50">
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.products.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Kelola Produk
                                </a>
                                <a href="{{ route('admin.categories.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Kelola Kategori
                                </a>
                                <a href="{{ route('admin.orders.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Kelola Pesanan
                                </a>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- =============== Right: Auth / User =============== -->
            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" 
                       class="text-gray-700 hover:text-blue-600 transition">Login</a>
                    <a href="{{ route('register') }}" 
                       class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition">Register</a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent 
                                                text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 
                                                111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 
                                                010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" 
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- =============== Mobile Menu Button =============== -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 
                                rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 
                                focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" 
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" 
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- =============== Responsive Menu (Mobile) =============== -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Produk</x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">Keranjang</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">Pesanan</x-responsive-nav-link>

                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard Admin</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">Kelola Produk</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">Kelola Kategori</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">Kelola Pesanan</x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- =============== Responsive Profile/Logout =============== -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" 
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 px-4">
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 mb-2">Login</a>
                <a href="{{ route('register') }}" class="block text-blue-600 hover:underline">Register</a>
            </div>
        @endauth
    </div>
</nav>
