<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DniController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretaryController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
// Dashboard general, autenticado y verificado
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Perfil de usuario (cualquiera autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/api/dni/{dni}', [DniController::class, 'consultar']); // Api
// ------------------------- Rutas por rol -------------------------
// Admin
Route::middleware(['auth', RoleMiddleware::class, ':admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dahboard');
    // Aquí van las rutas que un administrador puede acceder
});
// Lawyer
Route::middleware(['auth', RoleMiddleware::class.':lawyer'])->group(function () {
    Route::get('/lawyer/dashboard', [LawyerController::class, 'index'])->name('lawyer.dashboard');
    // Aquí van las rutas que un abogado puede acceder
});

// Secretary
Route::middleware(['auth', RoleMiddleware::class.':secretary'])->group(function () {
    Route::get('/secretary/dashboard', [SecretaryController::class, 'index'])->name('secretary.dashboard');
    // Aquí van las rutas que una secretaria puede acceder
});
require __DIR__.'/auth.php'; // <- lo dejamos, contiene login, register, etc.
