<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionTenantController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk landlord (super_admin dan admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/administrator', [SessionTenantController::class, 'landlordDashboard'])
        ->name('landlord.dashboard');
});

Route::prefix('{tenant}')->middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/dashboard', [SessionTenantController::class, 'index'])
        ->name('dashboard');
});

// Tambahkan route debug ini untuk pengecekan
Route::get('/debug-tenant-user', function () {
    if (!Auth::check()) {
        return "Not logged in";
    }

    $user = Auth::user();
    $tenant = $user->tenantUsers->first();

    return [
        'user_id' => $user->id,
        'user_type' => $user->user_type,
        'tenant' => $tenant ? [
            'id' => $tenant->id,
            'name' => $tenant->name,
            'path_id' => $tenant->path_id
        ] : null
    ];
});



require __DIR__ . '/auth.php';
