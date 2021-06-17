<?php

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

Route::get('/', function () {
    return redirect()->route('getLogin');
});
Route::get('/home/{id}', [App\Http\Controllers\MessageController::class, 'home'])->name('message.home');

Route::get('/login', [App\Http\Controllers\LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'getCreate'])->name('user.getCreate');
Route::post('/user/create', [App\Http\Controllers\UserController::class, 'postCreate'])->name('user.postCreate');
Route::post('/user/trash/{id}', [App\Http\Controllers\UserController::class, 'trash'])->name('user.trash');
Route::post('/user/restore/{id}', [App\Http\Controllers\UserController::class, 'restore'])->name('user.restore');
Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'getEdit'])->name('user.getEdit');
Route::post('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'postEdit'])->name('user.postEdit');
Route::post('message/send', [App\Http\Controllers\MessageController::class, 'send'])->name('message.send');
Route::get('message/index', [App\Http\Controllers\MessageController::class, 'index'])->name('message.index');
Route::get('/pusher', function() {
    event(new App\Events\HelloPusherEvent('Hi there Pusher!'));
    return "Event has been sent!";
});
