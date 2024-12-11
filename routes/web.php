<?php

use App\Livewire\Pages\Dashboard\DashboardIndex;
use App\Livewire\Pages\Product\ProductCreate;
use App\Livewire\Pages\Product\ProductIndex;
use App\Livewire\Pages\Product\ProductUpdate;
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
    Route::get('/', DashboardIndex::class);
    Route::get('/activos', ProductIndex::class);
    Route::get('/activos/create', ProductCreate::class);
    Route::get('/activos/edit/{id}', ProductUpdate::class);
});


require __DIR__ . '/auth.php';
