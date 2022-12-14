<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index'])->name('home');

// Posts
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post');
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

// Newsletter
Route::post('newsletter', NewsletterController::class);

// Register
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

// Login/Logout
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Admin
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});

// Feed
Route::feeds('/feed');

// Follow
Route::post('follow/{user:id}', [FollowController::class, 'store'])->middleware('auth');
Route::delete('follow/{user:id}', [FollowController::class, 'destroy'])->middleware('auth');

// Bookmarks
Route::get('bookmarks/', [BookmarkController::class, 'index'])->middleware('auth');
Route::post('bookmark/{post:id}', [BookmarkController::class, 'store'])->middleware('auth');
Route::delete('bookmark/{post:id}', [BookmarkController::class, 'destroy'])->middleware('auth');

// User
Route::get('profile/edit', [UserController::class, 'edit'])->middleware('auth');
Route::patch('profile/edit', [UserController::class, 'update'])->middleware('auth');