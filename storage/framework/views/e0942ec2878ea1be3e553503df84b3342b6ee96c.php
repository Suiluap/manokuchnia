<!DOCTYPE html>
<html lang="lt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
        <script src="<?php echo e(asset('js/functions.js')); ?>" defer></script>
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <title>Mano kuchnia</title>
    </head>
    <header class="mb-5">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="<?php echo e(route('index')); ?>">Mano kuchnia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarRecipesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Receptai
                        </a>
                        <div class="dropdown-menu shadow-sm" aria-labelledby="navbarRecipesDropdown">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <a class="dropdown-item" href="<?php echo e(route('recipes.category', $category->id)); ?>"><?php echo e($category->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                    <a class="nav-link" href="<?php echo e(route('recipes.new')); ?>">Naujas receptas</a>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">Prisijungti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>">Registruotis</a>
                    </li>
                    <?php endif; ?>
                    <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('users')); ?>">Naudotojai</a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aš
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarUserDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('recipes.user')); ?>">Receptai</a>
                            <a class="dropdown-item" href="<?php echo e(route('user')); ?>">Profilis</a>
                            <form action="<?php echo e(route('logout')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Atsijungti</button>
                            </form>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <body class="bg-white">
        <?php echo $__env->yieldContent('content'); ?>
    </body>
</html>
<?php /**PATH C:\Users\Paulius\Desktop\manokuchnia\resources\views/layouts/main.blade.php ENDPATH**/ ?>