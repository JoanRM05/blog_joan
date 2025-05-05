<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('blogs/all', [BlogController::class, 'allBlogs'])
    ->middleware(['auth', 'verified'])
    ->name('allBlogs');

Route::get('blogs/show/{id}', [BlogController::class, 'showBlog'])
    ->middleware(['auth', 'verified'])
    ->name('showBlog');

Route::get('blogs/myblogs', [BlogController::class, 'myBlogs'])
    ->middleware(['auth', 'verified'])
    ->name('myBlogs');

Route::view('blogs/myblogs/create', 'create-blog')
    ->middleware(['auth', 'verified'])
    ->name('blogCreation');

Route::post('blog/create', [BlogController::class, 'createBlog'])
    ->middleware(['auth', 'verified'])
    ->name('createBlog');

Route::get('blogs/myblogs/edit/{id}', [BlogController::class, 'editBlog'])
    ->middleware(['auth', 'verified'])
    ->name('editBlog');


Route::put('blog/update/{id}', [BlogController::class, 'updateBlog'])
    ->middleware(['auth', 'verified'])
    ->name('updateBlog');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
