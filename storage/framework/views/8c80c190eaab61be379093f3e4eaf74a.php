

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Harga</label>
                <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-between">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">
                    ← Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alfin\lelang_app\resources\views/admin/products/create.blade.php ENDPATH**/ ?>