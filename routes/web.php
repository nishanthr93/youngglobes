<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendCotroller;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\Auth\RegisterController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [UserController::Class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store']);


Route::middleware(['auth'])->group(function () {

    Route::post('/addfriend/{user}', [FriendCotroller::class, 'store'])->name('friend.addfriend');
    Route::post('/search/', [FriendCotroller::class, 'search'])->name('friend.search');

    Route::get('/match/', [FriendCotroller::class, 'match'])->name('friend.match');

    Route::resources([
        'posts' => PostController::class,
        'logout' => LogoutController::class
    ]);

    Route::get('/user/{user}', [UserController::Class, 'show'])->name('users.show');

    Route::get('/friends/{user}', [UserController::Class, 'searchFriend'])->name('users.friends');

    Route::get('/clear', function () {

        Storage::deleteDirectory('public');
        Storage::makeDirectory('public');

        Artisan::call('route:clear');
        Artisan::call('storage:link', []);
    });
});
