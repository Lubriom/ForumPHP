<?php

use App\Http\Controllers\HiloController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HiloController::class, 'index'])->name('home');
Route::get('hilo/{id}/posts', [PostController::class, 'verPost'])->name('verPost');
Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('images.get');

Route::get('/ranking', [UserController::class, 'ranking'])->name('ranking');
 
// Grupo para usuarios con el rol de admin o editor
Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::get('/control', [UserController::class, 'panel'])->name('ver.users');
    Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('edit.users');
    Route::post('/usuarios/{user}/update', [UserController::class, 'update'])->name('update.users'); 
}); 
 
// Grupo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/user/hilo/add', [HiloController::class, 'addHilo'])->name('user.add.hilo');
    Route::post('/user/hilo/create', [HiloController::class, 'createHilo'])->name('user.create.hilo');
    Route::post('/user/post/create/{post}', [PostController::class, 'createPost'])->name('user.create.post'); 
    Route::post('/user/post/like/{post}', [PostController::class, 'like'])->name('user.like.post');
});
 
// Grupo para usuarios con el rol de admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/control/delete/{user}', [UserController::class, 'destroy'])->name('admin.del.user');
    Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('admin.del.post');
});
 
// Grupo para usuarios autenticados (Control de perfil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
