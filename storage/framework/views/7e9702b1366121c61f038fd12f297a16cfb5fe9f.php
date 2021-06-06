<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('login')); ?>" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" novalidate>
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="username" class="sr-only">Slapyvardis</label>
        <input id="username" name="username" type="text" class="form-control <?php if($errors->has('username') || $errors->has('password') || session('status')): ?> border-danger <?php endif; ?>" placeholder="Slapyvardis">
        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Slaptažodis</label>
        <input id="password" name="password" type="password" class="form-control <?php if($errors->has('username') || $errors->has('password') || session('status')): ?> border-danger <?php endif; ?>" placeholder="Slaptažodis">
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-check mb-3">
        <input id="remember" name="remember" type="checkbox" class="form-check-input">
        <label for="remember" class="form-check-label">Atsiminti mane</label>
    </div>
    <?php if(session('status')): ?>
    <div class="text-danger mb-3">
        <?php echo e(session('status')); ?>

    </div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary w-100">Prisijungti</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/login.blade.php ENDPATH**/ ?>