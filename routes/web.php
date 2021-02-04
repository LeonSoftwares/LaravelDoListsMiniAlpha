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

Auth::routes(['register' => false, 'reset' => false]);

// Login and home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// To do lists
Route::group(['prefix' => 'do-lists'], function () {
 Route::post('/order', [App\Http\Controllers\DoListsController::class, 'order'])->name('do-order');
 Route::get('/', [App\Http\Controllers\DoListsController::class, 'index'])->name('do-lists');
 Route::match(['get', 'post'], '/create', [App\Http\Controllers\DoListsController::class, 'create'])->name('do-lists-create');
 Route::match(['get', 'post'], '/edit/{id?}', [App\Http\Controllers\DoListsController::class, 'edit'])->name('do-lists-edit');
 Route::get('/delete/{id}', [App\Http\Controllers\DoListsController::class, 'delete'])->name('do-lists-delete');
});

//Users list
Route::group(['prefix' => 'user-lists'], function () {
 Route::post('/order', [App\Http\Controllers\UserListsController::class, 'order'])->name('user-order');
 Route::get('/', [App\Http\Controllers\UserListsController::class, 'index'])->name('user-lists');
 Route::match(['get', 'post'], '/create', [App\Http\Controllers\UserListsController::class, 'create'])->name('user-lists-create');
 Route::match(['get', 'post'], '/edit/{id?}', [App\Http\Controllers\UserListsController::class, 'edit'])->name('user-lists-edit');
 Route::get('/delete/{id}', [App\Http\Controllers\UserListsController::class, 'delete'])->name('user-lists-delete');
});

//Import/Export
Route::group(['prefix' => 'import-export'], function () {
	Route::match(['get', 'post'],'/import-file-do', [App\Http\Controllers\ImportExportListsController::class, 'importFileDo'])->name('import-file-do');
	Route::match(['get', 'post'],'/import-file-user', [App\Http\Controllers\ImportExportListsController::class, 'importFileUser'])->name('import-file-user');
	Route::get('/export-file-user', [App\Http\Controllers\ImportExportListsController::class, 'exportFileUser'])->name('export-file-user');
	Route::get('/export-file-do', [App\Http\Controllers\ImportExportListsController::class, 'exportFileDo'])->name('export-file-do');
});

// Clear data
Route::get('/clear', function() {
	Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});