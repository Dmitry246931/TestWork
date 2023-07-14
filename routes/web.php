<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



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

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/main', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('main');

Route::middleware('auth')->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('/crete/{user}', [\App\Http\Controllers\AutoController::class, 'create'])->name('autos.create');
    Route::post('/store/{user}', [\App\Http\Controllers\AutoController::class, 'store'])->name('autos.store');
    Route::delete('/autos/delete/{user_id}', [\App\Http\Controllers\AutoController::class, 'destroy'])->name('autos.destroy');
    Route::get('/edit/{auto}', [\App\Http\Controllers\AutoController::class, 'edit'])->name('ss');
    Route::put('/update/update/{auto}', [\App\Http\Controllers\AutoController::class, 'update'])->name('autos.update');
    Route::get('/home', [\App\Http\Controllers\DropdownController::class, 'index'])->name('park');
    Route::get('/dropdown-data', [\App\Http\Controllers\DropdownController::class, 'data']);
    Route::post('/dropdown', [\App\Http\Controllers\DropdownController::class, 'auto'])->name('auto');
    Route::get('/dropdown-out/{avt}', [\App\Http\Controllers\DropdownController::class, 'auto_out'])->name('auto_out');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*require __DIR__ . '/auth.php';*/

/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/



require __DIR__.'/auth.php';
