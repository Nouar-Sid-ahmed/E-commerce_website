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
    return view('welcome');
});

Route::get('/catalogue', [App\Http\Controllers\CatalogueController::class, 'index'])->name('catalogue');

Route::get('/panier',[App\Http\Controllers\PanierController::class,'index'])->name('panier');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('admin');

Route::post('admin', [App\Http\Controllers\AdminController::class, 'store'])->name('admin')->middleware('admin');

Route::get('/produit/{produit}', [App\Http\Controllers\ProduitController::class, 'show'])->name('produit');

Route::post('/produit/{produit}', [App\Http\Controllers\ProduitController::class, 'update'])->name('update')->middleware('admin');

Route::post('/cart/{produit}', [App\Http\Controllers\PanierController::class, 'upgrade'])->name('upgrade');
