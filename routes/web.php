<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('welcome');
Route::post('/', [PostController::class, 'index'])->name('about');

// Create new post
Route::get('/post/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::post('/post/create', [PostController::class, 'store'])->name('post.create');

// read post
Route::get('/posts/{id}', [PostController::class, 'readPost'])->name('post.view');

// Update existing post
Route::get('/posts/{id}/update', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{id}/update', [PostController::class, 'update'])->name('post.update');

// Delete existing post
Route::delete('/post/{id}/delete', [PostController::class, 'delete'])->name('post.delete');

// Add and remove comment
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('post.comment.store');

// Add and remove like
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('post.like.store');
Route::post('/posts/{post}/destroylike', [LikeController::class, 'destroy'])->name('post.like.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [ProfileController::class, 'profileImage'])->name('profile.image.update');
});

require __DIR__ . '/auth.php';
