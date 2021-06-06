<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="container bg-light p-4 shadow-sm rounded mb-5" style="max-width: 540px">
        <h1 class="text-center">
            Jūsų profilis
        </h1>
        <hr>
        <div><b>Slapyvardis:</b> <?php echo e(Auth::user()->username); ?></div>
        <div><b>Vardas:</b> <?php echo e(Auth::user()->name); ?></div>
        <div><b>Pavardė:</b> <?php echo e(Auth::user()->surname); ?></div>
        <div><b>El. paštas:</b> <?php echo e(Auth::user()->email); ?></div>
        <hr>
        <a class="btn btn-primary"  href="<?php echo e(route('user.edit')); ?>">Redaguoti</a>
        <a class="btn btn-primary" href="<?php echo e(route('user.password')); ?>">Keisti slaptažodį</a>
        <form class="pull-right" action="<?php echo e(route('user')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti savo profilį?')"><i class="fa fa-trash"></i></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/user/view.blade.php ENDPATH**/ ?>