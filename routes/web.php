<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\GuestCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;


/*
|--------------------------------------------------------------------------
| Public Routes (Accessible to all visitors)
|--------------------------------------------------------------------------
*/

// Home page shows all posts
Route::get('/', [PostController::class, 'index'])->name('home');

// View a single post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Guests can add comments without logging in
Route::post('/comments/store', [GuestCommentController::class, 'store'])->name('guest.comments.store');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected, only for admin user)
|--------------------------------------------------------------------------
|
| Only the admin can log in and manage posts/comments.
| Registration routes are disabled to ensure a single admin.
|
*/

Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {
        Route::resource('posts', AdminPostController::class);
        Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
        Route::post('comments/{comment}/reply', [AdminCommentController::class, 'reply'])->name('comments.reply');
    });

/*
|--------------------------------------------------------------------------
| Profile Routes (for admin only)
|--------------------------------------------------------------------------
|
| Admin can edit their profile if needed.
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Login enabled only for admin. Registration routes removed.
|
*/
require __DIR__ . '/auth.php';
