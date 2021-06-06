<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if($recipes->count()): ?>
        <div class="container bg-light px-4 pt-4 shadow-sm rounded mb-5">
            <h1 class="text-center">Sveiki atvykę<?php if(Auth::check()): ?>, <?php echo e(Auth::user()->name); ?><?php endif; ?>!</h1>
            <hr>
            <?php $__currentLoopData = array_chunk($recipes->all(), 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipesChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <?php $__currentLoopData = $recipesChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card box-shadow">
                                <img class="card-img-top" alt="Patiekalo nuotrauka" style="height: 225px; width: 100%; display: block;" src=<?php echo e(asset("storage/pictures/$recipe->user_id/$recipe->image")); ?>>
                                <div class="card-body">
                                    <h2><?php echo e($recipe->name); ?></h2>
                                    <p class="card-text"><?php echo e(\Illuminate\Support\Str::limit($recipe->description, 100)); ?></p>
                                    
                                    <a href="#" class="btn btn-primary w-100">Daugiau</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="d-flex justify-content-center">
                <?php echo e($recipes->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center" style="max-width: 420px" >
            Dėja, šiuo metu svetainėje nėra receptų.
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/index.blade.php ENDPATH**/ ?>