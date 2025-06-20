<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirección inicial según estado de autenticación
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Dashboard (Vista principal tras login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil del usuario
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 
    // Vista principal del CRUD Users(blade con tabla)    
    Route::get('/users', function(){
        return view('users.index');
    })->name('users.indexBlade');

    Route::get('/proyects', function() {
        return view('calendar.index');    
    })->name('proyects.indexBlade');
    
    // API endpoints para AJAX
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('index');         // GET: listar todos los usuarios
        Route::post('/', [UserController::class, 'store'])->name('store');      // POST: crear nuevo usuario
        Route::get('/{user}', [UserController::class, 'show'])->name('show');   // GET: ver detalle
        Route::put('/{user}', [UserController::class, 'update'])->name('update'); // PUT: actualizar usuario
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy'); // DELETE: eliminar usuario
    });
});

require __DIR__.'/auth.php';
