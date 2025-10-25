

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto py-10 px-6">

   <!-- Tombol Kembali -->
    <a href="<?php echo e(route('admin.orders.index')); ?>" 
        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md mb-6 shadow transition"> 
    ← Kembali ke Daftar Pesanan 
    </a>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
           🧾 Detail Pesanan #<?php echo e($order->id); ?>

        </h1>
        <span class="px-3 py-1 text-sm rounded-full font-semibold 
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'bg-yellow-100 text-yellow-800' => strtolower($order->status) === 'pending',
                'bg-sky-100 text-sky-800' => strtolower($order->status) === 'diproses',
                'bg-indigo-100 text-indigo-800' => strtolower($order->status) === 'dikirim',
                'bg-green-100 text-green-800' => strtolower($order->status) === 'selesai',
                'bg-red-100 text-red-800' => strtolower($order->status) === 'dibatalkan',
           ]); ?>"">
             <?php echo e(ucfirst($order->status)); ?>

        </span>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
         <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
            Informasi Pelanggan
        </div>
        <div class="p-6 space-y-2 text-gray-700">
            <p><span class="font-semibold">Nama:</span> <?php echo e($order->user->name ?? 'Tidak Diketahui'); ?></p>
            <p><span class="font-semibold">Email:</span> <?php echo e($order->user->email ?? '-'); ?></p>
            <p><span class="font-semibold">Tanggal Pesan:</span> <?php echo e($order->created_at->format('d M Y H:i')); ?></p>
            <p><span class="font-semibold">Total:</span> Rp <?php echo e(number_format($order->total ?? 0, 0, ',', '.')); ?></p>
        </div>
    </div>

    <!-- Daftar Item Pesanan -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 mt-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
            Barang Dipesan
        </div>
        <div class="p-6">
            
            <?php if($order->items->isEmpty()): ?> 
                <p class="text-gray-500 text-center py-4">Tidak ada item dalam pesanan ini.</p>
           <?php else: ?>
             <table class="w-full border-collapse text-sm text-gray-700">
                     <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left px-4 py-2">Produk</th>
                            <th class="text-center px-4 py-2">Jumlah</th>
                            <th class="text-right px-4 py-2">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                         <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr class="border-b hover:bg-gray-50 transition">
                             <td class="px-4 py-2"><?php echo e($item->product->name ?? 'Produk Dihapus'); ?></td>
                             <td class="px-4 py-2 text-center"><?php echo e($item->quantity); ?></td>
                             <td class="px-4 py-2 text-right">Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Ubah Status -->
             <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 mt-8">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 font-semibold">
                    Ubah Status Pesanan
                </div>
                <div class="p-6">
                    <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="flex flex-col sm:flex-row gap-3 sm:items-center">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <select name="status" class="border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 w-full sm:w-auto">
                            <?php $__currentLoopData = ['pending','diproses','dikirim','selesai','dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e(strtolower($order->status) === $status ? 'selected' : ''); ?>>\
                                <?php echo e(ucfirst($status)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md shadow transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>