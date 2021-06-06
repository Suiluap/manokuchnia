<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-danger mb-4" style="max-width: 420px" >
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php if($users->count()): ?>
    <div class="container bg-light px-4 pt-4 shadow-sm rounded mb-5">
        <h1 class="text-center mb-3">Registruoti naudotojai</h1>

        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Slapyvardis</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>El. paštas</th>
                        <th class="text-center">Rolė</th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->surname); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <form action="<?php echo e(route('users.user.role', $user )); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <td class="d-flex justify-content-center">
                                    <select id="role" name="role" class="form-control" style="width:auto" onchange="this.form.submit()">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($role->id); ?> <?php echo e($role->id == $user->role_id ? "selected" : ""); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                            </form>
                            <form action="<?php echo e(route('users.delete.user', $user )); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <td class="text-center"><button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti šį naudotoją?')"><i class="fa fa-trash"></i></button></td>
                            </form>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <?php echo e($users->links()); ?>

        </div>
    </div>
    <?php else: ?>
    <div class="bg-light p-4 shadow-sm rounded mx-auto text-center" style="max-width: 420px" >
        Deja, šiuo metu svetainėje nėra registruotų naudotojų (išskyrus jus).
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/user/list.blade.php ENDPATH**/ ?>