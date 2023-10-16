<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('web/index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [HomeController::class]);
    /*Route::get('/home', [HomeController::class, 'index'])->name('home');*/

    Route::resource('post', PostController::class);
    Route::get('post', [PostController::class, 'index'])->name('posts.list');
    Route::resource('category', CategoryController::class);
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.list');
    Route::post('/category/create', [CategoryController::class, 'create'])->name('category.store');
    Route::delete('categories', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::delete('post', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('web/index', function (){
        return Inertia::render('postsApi');
    })->name('posts.home');
});

require __DIR__.'/auth.php';
