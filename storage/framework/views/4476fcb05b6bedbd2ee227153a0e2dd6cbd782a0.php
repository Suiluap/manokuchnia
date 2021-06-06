<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if($recipes->count()): ?>
        <div class="container bg-light px-4 pt-4 shadow-sm rounded mb-5">
            <h1 class="text-center">
                <?php if(isset($category)): ?>
                    <?php echo e($category); ?>

                <?php elseif(isset($isUserList)): ?>
                    Jūsų receptai
                <?php else: ?>
                    Sveiki atvykę<?php if(Auth::check()): ?>, <?php echo e(Auth::user()->name); ?><?php endif; ?>!
                <?php endif; ?>
            </h1>
            <hr>
            <?php $__currentLoopData = array_chunk($recipes->all(), 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipesChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <?php $__currentLoopData = $recipesChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top w-100 d-block" alt="Patiekalo nuotrauka" src=<?php echo e(asset("storage/pictures/$recipe->user_id/$recipe->image")); ?>>
                                <div class="card-body d-flex flex-column">
                                    <h2><?php echo e($recipe->name); ?></h2>
                                    <p class="card-text"><?php echo e(\Illuminate\Support\Str::limit($recipe->description, 100)); ?></p>
                                    <a href="<?php echo e(route('recipe', $recipe)); ?>" class="btn btn-primary w-100 mt-auto">Daugiau</a>
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
            <?php if(isset($category)): ?>
                Deja, šios kategorijos receptų nėra:(
            <?php elseif(isset($isUserList)): ?>
                Deja, neturite receptų:( Įkelkite receptą <a href="<?php echo e(route('recipes.new')); ?>">paspaudę čia</a>.
            <?php else: ?>
                Deja, šiuo metu svetainėje nėra receptų:(
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/recipes/list.blade.php ENDPATH**/ ?>