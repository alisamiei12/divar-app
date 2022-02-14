<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DCategoryController;
use App\Http\Controllers\Dashboard\DUserController;
use App\Http\Controllers\Dashboard\DPostController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes Authentication
|--------------------------------------------------------------------------
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/admin/register', [AuthController::class, 'registerAdminForm'])->name('register.admin.form');
    Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register.admin');

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Website Post Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/c/{slug}', [PostController::class, 'category'])->name('post.category');
Route::get('/p/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/manage/{slug}', [PostController::class, 'manage'])->name('post.manage');


   



Route::middleware('auth')->group(function () {
    Route::get('/mypost', [PostController::class, 'mypost'])->name('post.mypost');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/update', [PostController::class, 'update'])->name('post.update'); 
    Route::get('/editimg/{slug}', [PostController::class, 'editImg'])->name('post.edit.img');
    Route::post('/updateimg', [PostController::class, 'updateImg'])->name('post.update.img'); 
    Route::get('/delete/{slug}', [PostController::class, 'destroy'])->name('post.destroy');
});


/*
|--------------------------------------------------------------------------
| Dashboard Category Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin/category')->group(function () {

    Route::get('/', [DCategoryController::class, 'index'])->name('d.category.index');
    Route::get('/create', [DCategoryController::class, 'create'])->name('d.category.create');
    Route::post('/create', [DCategoryController::class, 'store'])->name('d.category.store');
    Route::get('/edit/{slug}', [DCategoryController::class, 'edit'])->name('d.category.edit');
    Route::post('/update', [DCategoryController::class, 'update'])->name('d.category.update');
    Route::post('/delete', [DCategoryController::class, 'destroy'])->name('d.category.destroy');

});


/*
|--------------------------------------------------------------------------
| Dashboard Post Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin/post')->group(function () {

    Route::get('/', [DPostController::class, 'index'])->name('d.post.index');
    Route::get('/filter/{status}', [DPostController::class, 'filter'])->name('d.post.filter');
    Route::get('/edit/{slug}/{status}', [DPostController::class, 'updateStatus'])->name('d.post.edit');
    Route::get('/manage/{slug}', [DPostController::class, 'manage'])->name('d.post.manage');
    Route::get('/c/{slug}', [DPostController::class, 'category'])->name('d.post.category');
    Route::get('/u/{slug}', [DPostController::class, 'user'])->name('d.post.user');
    Route::post('/delete', [DPostController::class, 'destroy'])->name('d.post.destroy');

});


/*
|--------------------------------------------------------------------------
| Dashboard User Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin/user')->group(function () {

    Route::get('/', [DUserController::class, 'index'])->name('d.user.index');
    Route::get('/edit/{slug}/{status}', [DUserController::class, 'updateStatus'])->name('d.user.edit');
    Route::post('/delete', [DUserController::class, 'destroy'])->name('d.user.destroy');

});
