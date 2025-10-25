

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-3xl bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Alamat Pengiriman -->
        <div class="mb-4">
            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
            <textarea name="shipping_address" id="shipping_address" rows="4" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Masukkan alamat lengkap"><?php echo e(old('shipping_address')); ?></textarea>
            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Ringkasan Keranjang -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Ringkasan Pesanan</h2>
            <ul class="divide-y divide-gray-200">
                <?php $cartTotal = 0; ?>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $subtotal = $cart->product->price * $cart->quantity; ?>
                    <?php $cartTotal += $subtotal; ?>
                    <li class="py-2 flex justify-between">
                        <span><?php echo e($cart->product->name); ?> x <?php echo e($cart->quantity); ?></span>
                        <span>Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="mt-2 flex justify-between font-bold">
                <span>Total</span>
                <span>Rp <?php echo e(number_format($cartTotal, 0, ',', '.')); ?></span>
            </div>
        </div>

        <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">
            Pesan Sekarang
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/cart/checkout.blade.php ENDPATH**/ ?>