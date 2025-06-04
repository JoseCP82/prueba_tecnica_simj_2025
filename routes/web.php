<?php

use App\Http\Controllers\ProfileController;
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
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil del usuario
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | CRUD de usuarios (AdminLTE)
    |--------------------------------------------------------------------------
    | - /users → Vista blade (menú)
    | - /api/users → Endpoints AJAX
    */
    
    // Vista principal del CRUD (blade con tabla)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // API endpoints para AJAX
    Route::prefix('api/users')->name('api.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');         // GET: listar todos los usuarios
        Route::post('/', [UserController::class, 'store'])->name('store');      // POST: crear nuevo usuario
        Route::get('/{user}', [UserController::class, 'show'])->name('show');   // GET: ver detalle
        Route::put('/{user}', [UserController::class, 'update'])->name('update'); // PUT: actualizar usuario
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy'); // DELETE: eliminar usuario
    });

});

require __DIR__.'/auth.php';
