<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\LikeController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [PostController::class, 'index'])->name('index');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::post('/posts/like', 'like')->name('posts.like');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
});

Route::get('/categories/{category}', [CategoryController::class,'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::post('/posts/like', [PostController::class, 'like'])->name('posts.like');

Route::get('/posts/create', [PostController::class, 'create']);  //投稿フォームの表示
Route::post('/posts', [PostController::class, 'store']);  //画像を含めた投稿の保存処理
Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');

Route::post('/posts/posts', [CommentController::class,'store'])->name('comment.store');


Route::get('/ranking', [RankingController::class,'index'])->name('ranking');

Route::get('/likes', [LikeController::class,'index'])->name('likes');

Route::get('/posts/ranking', [RankingController::class, 'ranking']);




require __DIR__.'/auth.php';
