

<?php $__env->startSection('content'); ?>

<div class="max-w-6xl mx-auto py-10 px-6"> <div class="bg-white shadow-lg rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl md:flex">
    <!-- 🖼️ Gambar Produk -->
    <div class="md:w-1/2 flex items-center justify-center bg-gray-50 p-6">
        <img src="<?php echo e($product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/500x400?text=No+Image'); ?>" 
             alt="<?php echo e($product->name); ?>" 
             class="rounded-xl w-full max-h-[400px] object-cover transition-transform duration-300 hover:scale-105">
    </div>

    <!-- 🏷️ Info Produk -->
    <div class="md:w-1/2 p-8 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800"><?php echo e($product->name); ?></h1>
            <p class="text-2xl text-green-600 font-semibold mt-3 mb-4">
                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

            </p>

            <p class="text-gray-600 leading-relaxed">
                <?php echo e($product->description ?? 'Tidak ada deskripsi produk untuk item ini.'); ?>

            </p>
        </div>

        <!-- ⚙️ Tombol Aksi -->
        <div class="mt-8 flex flex-wrap gap-4">
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role !== 'admin'): ?>
                    <!-- 🛒 Tambah ke Keranjang -->
                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>

                    <!-- ⚡ Pesan Sekarang -->
                    <form action="<?php echo e(route('orders.quick', $product->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                            Pesan Sekarang
                        </button>
                    </form>
                <?php else: ?>
                    <!-- 🚫 Admin tidak bisa beli -->
                    <p class="text-red-600 font-semibold mt-2">
                        Admin tidak dapat melakukan pembelian.
                    </p>
                <?php endif; ?>
            <?php else: ?>
                <!-- 🔐 Tombol Login -->
                <a href="<?php echo e(route('login')); ?>" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-all">
                    Login untuk Memesan
                </a>
            <?php endif; ?>

            <!-- ⬅️ Kembali -->
            <a href="<?php echo e(route('home')); ?>" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-6 py-3 rounded-lg shadow-sm transition-all duration-200">
               ← Kembali ke Produk
            </a>
        </div>
    </div>
</div>

</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/products/show.blade.php ENDPATH**/ ?>