<?php

use App\Http\Controllers\control_master;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[control_master::class,'home']
)->name('home');
Route::get('/create',[control_master::class,'index'])->name('create');
Route::get('/login',[control_master::class,'login_view'])->name('login_view');
Route::post('/verification',[control_master::class,'verification'])->name('verification');
Route::post('/verification_login',[control_master::class,'verification_login'])->name('verification_login');
Route::get('/logout',[control_master::class,'logout'])->name('logout');
Route::post('/stock',[control_master::class,'stock'])->name('stock');
Route::get('/panier',[control_master::class,'panier_view'])->name('panier_view')->middleware('auth');
Route::post('/delete',[control_master::class,'delete'])->name('delete');
Route::post('/form_confirmation',[control_master::class,'form_confirmation_view'])->name('form_confirmation_view');
Route::put('/stock_confirmation',[control_master::class,'stock_confirmation'])->name('stock_confirmation');
Route::post('/confirmer',[control_master::class,'confirmer'])->name('confirmer');
Route::get('/fast_food', [control_master::class, 'fastfood'])->name('fast_food');
Route::get('/home_food', [control_master::class, 'homefood'])->name('home_food');
Route::get('/test',[control_master::class,'test'])->name('test');

