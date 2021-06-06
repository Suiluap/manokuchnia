<?php $__env->startSection('content'); ?>



<form action="<?php echo e(route('recipes.new')); ?>" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" enctype="multipart/form-data" novalidate>
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="name" class="sr-only">Pavadinimas</label>
        <input id="name" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Pavadinimas" value="<?php echo e(old('name')); ?>">
        <?php $__errorArgs = ['name'];
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
        <label for="image" class="mb-0">Nuotrauka</label>
        <small id="imageHelp" class="text-muted">Paspauskite žemiau esantį mygtuką.</small>
        
        
        <input id="image" name="image" type="file" class="form-control-file">
        <?php $__errorArgs = ['image'];
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
        <label for="description" class="sr-only">Aprašymas</label>
        <textarea id="description" name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Aprašymas"><?php echo e(old('description')); ?></textarea>
        <?php $__errorArgs = ['description'];
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
        <label for="portions" class="sr-only">Porcijos</label>
        <input id="portions" name="portions" type="number" min="1" class="form-control <?php $__errorArgs = ['portions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Porcijos" value="<?php echo e(old('portions')); ?>">
        <?php $__errorArgs = ['portions'];
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
        <label for="category" class="sr-only">Kategorija</label>
        <select id="category" name="category" class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value=""  <?php echo e(is_null(old('category')) ? "selected" : ""); ?> hidden>Kategorija</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value=<?php echo e($category->id); ?> <?php echo e($category->id == old('category') ? "selected" : ""); ?>><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['category'];
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
        <div class="mb-2">
            <span>Ingredientai</span>
            <button id="addIngredient" type="button" class="btn btn-success float-right badge p-2" onclick="add('ingredient')"><i class="fa fa-plus"></i></button>
        </div>
        <?php if(old('ingredient') == null && old('quantity') == null && old('measurement') == null): ?>
            <div id="inputFormRow" class="mb-1">
                <div class="input-group">
                    <label for="ingredient" class="sr-only">Ingredientas</label>
                    <input id="ingredient" name="ingredient[]" type="text" class="form-control rounded-left" placeholder="Ingredientas">
                    <label for="quantity" class="sr-only">Kiekis</label>
                    <input id="quantity" name="quantity[]" type="text" class="form-control" placeholder="Kiekis">
                    <label for="measurement" class="sr-only">Matavimo vienetas</label>
                    <input id="measurement" name="measurement[]" type="text" class="form-control" placeholder="Matavimo vienetas">

                    <div class="input-group-append">
                        <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <?php if($errors->has('ingredient') || $errors->has('quantity') || $errors->has('measurement')): ?>
                    <div class="text-danger">
                        <?php echo e($errors->first('ingredient')); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php else: ?>
            <?php ($i = 0); ?>
            <?php $__currentLoopData = old('ingredient'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="ingredient" class="sr-only">Ingredientas</label>
                        <input id="ingredient" name="ingredient[]" type="text" class="form-control rounded-left <?php if($errors->has('ingredient.'.$i)): ?> border-danger <?php endif; ?>" placeholder="Ingredientas" value=<?php echo e(old('ingredient.'.$i)); ?>>
                        <label for="quantity" class="sr-only">Kiekis</label>
                        <input id="quantity" name="quantity[]" type="number" class="form-control <?php if($errors->has('quantity.'.$i)): ?> border-danger <?php endif; ?>" placeholder="Kiekis" value=<?php echo e(old('quantity.'.$i)); ?>>
                        <label for="measurement" class="sr-only">Matavimo vienetas</label>
                        <input id="measurement" name="measurement[]" type="text" class="form-control <?php if($errors->has('measurement.'.$i)): ?> border-danger <?php endif; ?>" placeholder="Matavimo vienetas" value=<?php echo e(old('measurement.'.$i)); ?>>

                        <div class="input-group-append">
                            <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <?php if($errors->has('ingredient.'.$i)): ?>
                        <div class="text-danger">
                            Ingredientas - <?php echo e($errors->first('ingredient.'.$i)); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->has('quantity.'.$i)): ?>
                        <div class="text-danger">
                            Kiekis - <?php echo e($errors->first('quantity.'.$i)); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->has('measurement.'.$i)): ?>
                        <div class="text-danger">
                            Matavimo vienetas - <?php echo e($errors->first('measurement.'.$i)); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($loop->last): ?>
                        <?php if($errors->has('ingredient') || $errors->has('quantity') || $errors->has('measurement')): ?>
                            <div class="text-danger">
                                <?php echo e($errors->first('ingredient')); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php endif; ?>
                </div>
                <?php ($i ++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div id="newIgredients"></div>
    </div>

    <div class="form-group">
        <div class="mb-2">
            <span>Instrukcija</span>
            <button id="addStep" type="button" class="btn btn-success float-right badge p-2" onclick="add('step')"><i class="fa fa-plus"></i></button>
        </div>
        <?php if(old('step') == null): ?>
            <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="step" class="sr-only">Žingsnis</label>
                    <input id="step" name="step[]" type="text" class="form-control rounded-left" placeholder="Žingsnis">

                    <div class="input-group-append">
                        <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <?php $__errorArgs = ['step'];
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
        <?php else: ?>
            <?php ($i = 0); ?>
            <?php $__currentLoopData = old('step'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="step" class="sr-only">Žingsnis</label>
                        <input id="step" name="step[]" type="text" class="form-control rounded-left  <?php if($errors->has('step.'.$i)): ?> border-danger <?php endif; ?>" placeholder="Žingsnis" value=<?php echo e($old); ?>>

                        <div class="input-group-append">
                            <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <?php if($errors->has('step.'.$i)): ?>
                        <div class="text-danger">
                            <?php echo e($errors->first('step.'.$i)); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($loop->last): ?>
                        <?php $__errorArgs = ['step'];
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
                    <?php endif; ?>
                </div>
                <?php ($i ++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div id="newSteps"></div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Įkelti</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/recipes/new.blade.php ENDPATH**/ ?>