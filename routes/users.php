<?php
use Illuminate\Support\Facades\Route;

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['users']], function() {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
?>
