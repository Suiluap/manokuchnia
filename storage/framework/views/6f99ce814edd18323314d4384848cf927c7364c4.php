<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="container bg-light pt-4 px-4 shadow-sm rounded mb-5">
        <div class="row">
            <div class="col-md-6">
                <img class="w-100 d-block mb-3-md rounded" alt="Patiekalo nuotrauka" src=<?php echo e(asset("storage/pictures/$recipe->user_id/$recipe->image")); ?>>
            </div>
            <div class="col-md-6">
                <h1 class="d-inline"><?php echo e($recipe->name); ?></h1>

                <?php if(Auth::check() && ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin())): ?>
                    <form class="pull-right" action="<?php echo e(route('recipe', $recipe )); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti šį receptą?')"><i class="fa fa-trash"></i></button>
                    </form>
                <?php endif; ?>

                <div>
                    @<i><?php echo e($recipe->user->username); ?></i>
                </div>

                <p class="mb-1"><?php echo e($recipe->description); ?></p>

                <div>
                    <label for="portions">Porcijos:</label>
                    <input id="portions" name="portions" type="number" min="1" max="99" style="width: 45px;" value="<?php echo e($recipe->portions); ?>" onmouseup="calculateIngredients()" onkeyup="calculateIngredients()">
                    <input type="hidden" id="oldPortions" value="<?php echo e($recipe->portions); ?>"/>
                </div>

                <hr>
                <h2>Ingredientai</h2>
                <ul>
                <?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="ingredient"><?php echo e($ingredient->name); ?>, <span class="quantity"><?php echo e($ingredient->quantity); ?></span> <?php echo e($ingredient->measurement); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <hr>
                <h2>Instrukcija</h2>
                <ol class="mb-0">
                <?php $__currentLoopData = $recipe->steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($step->instructions); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>

                <?php if(Auth::check() && ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin())): ?>
                    <a class="btn btn-primary btn-block mt-3" href="<?php echo e(route('recipe.edit', $recipe)); ?>">Redaguoti</a>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div>
            <h2>Komentarai</h2>
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('recipe', $recipe)); ?>" class="mb-2" method="post" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="d-flex">
                        <label for="comment" class="sr-only">Komentaras</label>
                        <textarea id="comment" name="comment" class="form-control mr-1 <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="1" placeholder="Komentaras"><?php echo e(old('comment')); ?></textarea>
                        <button type="submit" class="btn btn-primary">Įrašyti</button>
                    </div>
                    <?php $__errorArgs = ['comment'];
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
                </form>
            <?php endif; ?>



            <?php if($comments->count()): ?>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border rounded p-2 mt-2">
                        <div>
                            @<i><?php echo e($comment->user->username); ?></i> -
                            <small class="text-muted">
                                <?php echo e($comment->created_at->diffForHumans()); ?>

                            </small>
                            <?php if(Auth::check() && ($comment->ownedBy(Auth::user()) || Auth::user()->isAdmin())): ?>
                                <form class="pull-right" action="<?php echo e(route('comment', $comment )); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger badge badge-pill"><i class="fa fa-minus"></i></button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <p class="mb-0"><?php echo e($comment->text); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-center mt-3">
                    <?php echo e($comments->links()); ?>

                </div>
            <?php else: ?>
                <p class="mb-0 pb-3">
                    <?php if(auth()->guard()->check()): ?>
                        Būkite pirmieji pakomentavę šį receptą:)
                    <?php else: ?>
                        Deja, šis receptas kol kas neturi komentarų:(
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/recipes/view.blade.php ENDPATH**/ ?>