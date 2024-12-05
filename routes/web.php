<?php

use App\Livewire\Pages\Product\ProductIndex;
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




Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::get('/activos', ProductIndex::class);
});


require __DIR__ . '/auth.php';
