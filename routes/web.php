<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// dashboard routes
Route::get('/', [DashboardController::class, 'index']) -> name('dashboard');

// ideas routes

// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.', 'middleware' => ['auth']], function() {
//     Route::get('{idea}', [IdeaController::class, 'show']) -> name('show');
//     Route::post('', [IdeaController::class, 'store']) -> name('store');
//     Route::get('{idea}/edit', [IdeaController::class, 'edit']) -> name('edit');
//     Route::put('{idea}', [IdeaController::class, 'update']) -> name('update');
//     Route::delete('{idea}', [IdeaController::class, 'destroy']) -> name('destroy');
// });

Route::resource('ideas', IdeaController::class)->except(['index', 'create'])->middleware('auth');


// comments routes

// Route::group([], function(){
//         Route::post('/ideas/{idea}/comments', [CommentController::class, 'store']) -> name('ideas.comments.store');
// });

Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

// users route
Route::resource('/users', UserController::class) -> only(['show']);
Route::resource('/users', UserController::class) -> only(['edit', 'update']) -> middleware('auth');

// follow // unfollow
Route::post('users/{user}/follow',[FollowerController::class, 'follow']) ->middleware(['auth'])->name('users.follow');

Route::post('users/{user}/unfollow',[FollowerController::class, 'unfollow']) ->middleware(['auth'])->name('users.unfollow');

// like // unlike

Route::post('ideas/{idea}/like',[IdeaLikeController::class, 'like']) ->middleware(['auth'])->name('ideas.like');

Route::post('ideas/{idea}/unlike',[IdeaLikeController::class, 'unlike']) ->middleware(['auth'])->name('ideas.unlike');

// profile routes

Route::get('profile', [UserController::class, 'profile'])->middleware(['auth']) -> name('profile');

// feed

Route::get('/feed', FeedController::class) -> middleware('auth') -> name('feed');

// admin
// Route::get('/admin', [AdminDashboard::class, 'index']) -> name('admin.dashboard') -> middleware(['auth', 'isAdmin']);

Route::get('/admin', [AdminDashboard::class, 'index']) -> name('admin.dashboard') -> middleware(['auth', 'can:isAdmin']);

// Language Routes

Route::get('lang/{lang}', function($lang){
    app() -> setLocale($lang);
    session() -> put('lang', $lang);
    return redirect() -> route('dashboard');
}) -> name('lang');
