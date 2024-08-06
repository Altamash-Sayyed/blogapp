<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Types\Relations\Role;

// Route::get('/', function () {
//     return view('welcome');
// });



//for login view
Route::get('login', [UserController::class, 'index'])->name('login');
//for login with post
Route::post('login', [UserController::class, 'login']);

//for register view
Route::get('register', [UserController::class, 'register_view'])->name('register');
//for register with post
Route::post('register', [UserController::class, 'register'])->name('register');

//For homepage and non authenticate user
Route::get('/', [PostController::class, 'all']);

Route::middleware('auth')->group(function () {
    //logout
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('profile', [PostController::class, 'index'])->name('profile');

    // Blog CRUD operations
    //get post single
    Route::get('post/{post}', [PostController::class, 'show'])->name('posts.show');

    // Create
    Route::get('create', [PostController::class, 'create'])->name('posts.create');
    Route::post('post', [PostController::class, 'store'])->name('posts.store');

    // Update
    Route::get('update/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('post/{post}', [PostController::class, 'update'])->name('posts.update');

    // Delete
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


    ###->for comment
    // Add comment
    Route::post('post/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Show comments for a post
    // Route::get('post/{post}', [CommentController::class, 'show'])->name('posts.show');
});
