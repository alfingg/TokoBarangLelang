

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto py-10 px-4">
    <!-- 🔙 Tombol Kembali -->
    <a href="<?php echo e(route('orders.index')); ?>" 
       class="text-blue-700 hover:text-blue-900 transition duration-150 inline-flex items-center mb-6 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" 
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 
                     01-1.414 1.414l-4-4a1 1 0 
                     010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Kembali ke Daftar Pesanan
    </a>

    <!-- 🧾 Judul -->
    <h1 class="text-3xl font-bold mb-8 text-gray-800">
        Detail Pesanan #<?php echo e($order->id); ?>

    </h1>

    <div class="space-y-8">
        <!-- 📦 Ringkasan Pesanan -->
        <div class="bg-gradient-to-r from-blue-50 via-white to-blue-50 shadow-lg rounded-2xl p-6 border border-blue-100">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.656 0 3-1.344 3-3S13.656 2 12 2 9 3.344 9 5s1.344 3 3 3zM6 22v-2a6 6 0 0112 0v2H6z" />
                </svg>
                Ringkasan Pesanan
            </h2>

            <?php
                $statusColors = [
                    'Pending' => 'bg-yellow-100 text-yellow-800 border-yellow-400',
                    'Diproses' => 'bg-blue-100 text-blue-800 border-blue-400',
                    'Dikirim' => 'bg-indigo-100 text-indigo-800 border-indigo-400',
                    'Selesai' => 'bg-green-100 text-green-800 border-green-400',
                    'Dibatalkan' => 'bg-red-100 text-red-800 border-red-400',
                ];
                $statusClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-400';
            ?>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                <p class="text-gray-600 font-medium">Status Pesanan:</p>
                <span class="px-4 py-2 rounded-full border text-sm font-semibold <?php echo e($statusClass); ?>">
                    <?php echo e(ucfirst($order->status)); ?>

                </span>
            </div>

            <div class="border-t border-gray-200 mt-4 pt-4 text-gray-700">
                <p class="mb-2">
                    <strong>Tanggal Pesan:</strong> <?php echo e($order->created_at->format('d M Y, H:i')); ?>

                </p>
                <p class="text-lg font-bold">
                    Total Pembayaran: 
                    <span class="text-blue-700">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></span>
                </p>
            </div>
        </div>

        <!-- 🚚 Alamat Pengiriman -->
        <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
            <h2 class="text-xl font-semibold mb-3 text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l1.664 1.664a5 5 0 006.672 0L13 10m0 0V4m0 6H4" />
                </svg>
                Alamat Pengiriman
            </h2>
            <p class="text-gray-700 mb-1"><strong>Penerima:</strong> <?php echo e($order->user->name ?? 'Tamu'); ?></p>
            <p class="text-gray-600">
                <?php echo e($order->shipping_address ?? 'Alamat pengiriman belum diisi.'); ?>

            </p>
        </div>

        <!-- 🧺 Daftar Item -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3zm3 6h12M9 3v18m6-18v18" />
                </svg>
                Item yang Dipesan
            </h2>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-blue-50 text-blue-800">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Produk</th>
                            <th class="px-6 py-3 text-left font-medium">Harga</th>
                            <th class="px-6 py-3 text-center font-medium">Qty</th>
                            <th class="px-6 py-3 text-right font-medium">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php $__empty_1 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                <?php echo e($item->product->name ?? 'Produk Dihapus'); ?>

                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                            </td>
                            <td class="px-6 py-4 text-center text-gray-600"><?php echo e($item->quantity); ?></td>
                            <td class="px-6 py-4 text-right font-semibold text-gray-800">
                                Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 italic">
                                Tidak ada item dalam pesanan ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-200 text-right">
                <p class="text-lg font-semibold text-gray-800">
                    Total Pesanan: <span class="text-blue-700 font-bold">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></span>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/orders/show.blade.php ENDPATH**/ ?>