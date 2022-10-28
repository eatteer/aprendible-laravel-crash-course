<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

// HOME
Route::view('/', 'home')->name('home');

// POSTS
/*Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::patch('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');*/

Route::resource(
    '/posts',
    PostsController::class,
    ['parameters' => ['posts' => 'id']]
);

// ABOUT
Route::view('/about', 'about')->name('about');

// CONTACT
Route::view('/contact', 'contact')->name('contact');

// LOGIN
Route::get('/login', function () {
    return 'Login';
})->name('login');

// LOGIN
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

// LOGOUT
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');

// REGISTER
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
