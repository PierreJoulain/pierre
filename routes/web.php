<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PostController::class, 'index'])->name('welcome');

Route::get('/login',[PostController::class, 'login'])->name('login');



Route::get('/register',[PostController::class,'register']);


Route::get('/contact',[PostController::class, 'contact'])->name('contact');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('posts/{id}/comment',[PostController::class, 'createComment'])->name('posts.comments.store');



    Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/create',[PostController::class, 'store'])->name('posts.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/posts/comments/{id}',[PostController::class, 'destroyComment'])->name('comments.delete');
    Route::delete('/posts/{id}',[PostController::class, 'destroyPost'])->name('posts.delete');
    Route::patch('/posts/comments/{id}',[PostController::class, 'updateComment'])->name('comments.update');
    Route::patch('/posts/{id}',[PostController::class, 'updatePost'])->name('posts.update');
});

Route::get('/posts/{id}',[PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
