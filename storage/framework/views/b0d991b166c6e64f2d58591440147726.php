

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto py-10 px-4"> 
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Daftar Pesanan</h1>
<?php if(session('success')): ?>
   <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-lg border border-green-300">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded-lg border border-red-300">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="w-full text-sm text-gray-700">
        <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nama Pelanggan</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
             <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
             <tr class="border-b hover:bg-blue-50 transition duration-200">
                <td class="px-4 py-3 font-semibold text-gray-800">#<?php echo e($order->id); ?></td>
                <td class="px-4 py-3"><?php echo e($order->user->name ?? '-'); ?></td>
                <td class="px-4 py-3 font-medium">
                     Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

                     </td>

                     <td class="px-4 py-3">
                         <?php
                          $statusColors = [
                             'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                             'diproses' => 'bg-sky-100 text-sky-800 border-sky-300',
                              'dikirim' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
                               'selesai' => 'bg-green-100 text-green-800 border-green-300',
                                'dibatalkan' => 'bg-red-100 text-red-800 border-red-300',
                                 ];
                                  $color = $statusColors[strtolower($order->status)] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                  ?>
                                   <span class="px-3 py-1 inline-flex items-center border rounded-full text-xs font-semibold <?php echo e($color); ?>">
                                     <?php echo e(ucfirst($order->status)); ?>

                                     </span>
                                     </td>

                                     <td class="px-4 py-3 text-gray-600">
                                         <?php echo e($order->created_at->format('d M Y H:i')); ?>

                                         </td>

                                         <td class="px-4 py-3 text-center flex justify-center space-x-2">
                                            
                                             <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
                                             class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md shadow-sm transition">
                                              Detail
                                             </a>

                                             
                                              <?php if(strtolower($order->status) === 'selesai' || strtolower($order->status) === 'dibatalkan'): ?>
                                               <form action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>" method="POST" 
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan #<?php echo e($order->id); ?> secara permanen? Tindakan ini tidak dapat dibatalkan.');"
                                                 class="inline-block">
                                                  <?php echo csrf_field(); ?>
                                                   <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                     class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-2 rounded-md shadow-sm transition">
                                                      Hapus
                                                     </button>
                                                     </form>
                                                      <?php endif; ?>
                                                     </td>
                                                     </tr>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                       <tr>
                                                       <td colspan="6" class="text-center text-gray-500 py-6">
                                                        Belum ada pesanan yang masuk.
                                                     </td>
                                                    </tr>
                                                     <?php endif; ?>
                                                    </tbody>
                                                </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    <?php echo e($orders->links('pagination::tailwind')); ?>

</div>

</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>