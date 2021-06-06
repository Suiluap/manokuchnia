<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RecipeController::class, 'index'])->name('index');

Route::get('/recipes/category/{category}', [RecipeController::class, 'categoryIndex'])->name('recipes.category');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('role:Naudotojas,Administratorius')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/recipes/new', [RecipeController::class, 'newRecipeIndex'])->name('recipes.new');
    Route::post('/recipes/new', [RecipeController::class, 'newRecipe']);

    Route::delete('/recipes/{recipe}', [RecipeController::class, 'deleteRecipe']);

    Route::get('/user/recipes', [RecipeController::class, 'userRecipesIndex'])->name('recipes.user');

    Route::get('/recipe/edit/{recipe}', [RecipeController::class, 'editRecipeIndex'])->name('recipe.edit');
    Route::post('/recipe/edit/{recipe}', [RecipeController::class, 'editRecipe']);

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::delete('/user', [UserController::class, 'delete']);

    Route::get('/user/edit', [UserController::class, 'editIndex'])->name('user.edit');
    Route::post('/user/edit', [UserController::class, 'edit']);

    Route::get('/user/password', [UserController::class, 'changePasswordIndex'])->name('user.password');
    Route::post('/user/password', [UserController::class, 'changePassword']);

    Route::post('/recipes/{recipe}', [RecipeController::class, 'comment']);

    Route::delete('/comments/{comment}', [RecipeController::class, 'deleteComment'])->name('comment');
});

Route::middleware('role:Administratorius')->group(function () {
    Route::get('/users', [UserController::class, 'listIndex'])->name('users');

    Route::delete('/users/delete/{user}', [UserController::class, 'deleteUser'])->name('users.delete.user');

    Route::post('/users/{user}/role', [UserController::class, 'changeRole'])->name('users.user.role');
});

Route::get('/recipes/{recipe}', [RecipeController::class, 'recipeIndex'])->name('recipe');
