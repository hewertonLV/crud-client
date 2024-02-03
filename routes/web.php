<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', [ClientController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/client')->group(function () {
        Route::get('', [ClientController::class,'index'])->name('clients');
        Route::get('create', [ClientController::class,'create'])->name('createClients');
        Route::get('/edit/{client}', [ClientController::class, 'edit'])->name('editClient');
        Route::post('/store', [ClientController::class, 'store'])->name('storeClient');
        Route::put('/update/{client}', [ClientController::class, 'update'])->name('updateClient');
        Route::delete('/destroy/{client}', [ClientController::class, 'destroy'])->name('destroyClient');
    });
});

require __DIR__ . '/auth.php';
