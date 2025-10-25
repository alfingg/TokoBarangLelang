{{-- Asumsi menggunakan layout master 'layouts.app' --}}
@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
    <div class="container mt-4">

        {{-- Judul Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Utama Anda</h2>
            <small class="text-muted">Halo, {{ Auth::user()->name ?? 'Pengguna' }}! Selamat datang kembali.</small>
        </div>

        {{-- Bagian Statistik (Cards) --}}
        <div class="row">
            {{-- Card 1: Total Produk (Tautan ini SEKARANG berfungsi karena rute 'products.index' sudah ada) --}}
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Lihat Produk</h5>
                            <p class="card-text fs-3 fw-bold">1,250</p>
                        </div>
                        <i class="fas fa-boxes card-icon">📦</i>
                    </div>
                    <div class="card-footer bg-primary border-0">
                        {{-- BARIS KODE YANG SUDAH KINI BENAR: products.index --}}
                        <a href="{{ route('products.index') }}" class="text-white text-decoration-none">Lihat Semua Produk &raquo;</a>
                    </div>
                </div>
            </div>

            {{-- Card 2: Pesanan Saya --}}
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Pesanan Saya</h5>
                            {{-- Ganti 45 dengan variabel actual, misal: $pendingOrdersCount --}}
                            <p class="card-text fs-3 fw-bold">45</p>
                        </div>
                        <i class="fas fa-shopping-cart card-icon">🛒</i>
                    </div>
                    <div class="card-footer bg-success border-0">
                        <a href="{{ route('orders.index') }}" class="text-white text-decoration-none">Lihat Pesanan &raquo;</a>
                    </div>
                </div>
            </div>

            {{-- Card 3: Profil Saya --}}
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Profil</h5>
                            <p class="card-text fs-3 fw-bold">Kelola</p>
                        </div>
                        <i class="fas fa-users card-icon">👥</i>
                    </div>
                    <div class="card-footer bg-info border-0">
                        <a href="{{ route('profile.edit') }}" class="text-white text-decoration-none">Edit Profil &raquo;</a>
                    </div>
                </div>
            </div>
            
             {{-- Card 4: Keranjang Belanja --}}
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Keranjang</h5>
                            {{-- Ganti 3 dengan variabel actual, misal: $cartItemCount --}}
                            <p class="card-text fs-3 fw-bold">3</p>
                        </div>
                        <i class="fas fa-shopping-cart card-icon">🛍️</i>
                    </div>
                    <div class="card-footer bg-warning border-0">
                        <a href="{{ route('cart.index') }}" class="text-white text-decoration-none">Lihat Keranjang &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Area Informasi Tambahan --}}
        <div class="row mt-4">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Aktivitas Pesanan Terbaru
                    </div>
                    <ul class="list-group list-group-flush">
                        {{-- Contoh data nyata dari controller --}}
                        <li class="list-group-item">Pesanan **#1001** berhasil dibayar. <span class="badge bg-success">Lunas</span></li>
                        <li class="list-group-item">Pesanan **#1002** menunggu pembayaran. <span class="badge bg-warning">Tertunda</span></li>
                        <li class="list-group-item">Pesanan **#1003** sedang diproses. <span class="badge bg-primary">Diproses</span></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection