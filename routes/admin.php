<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;

Route::get('/admin-logout', [LoginController::class, 'logout'])->name('admin-logout');

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
    Route::get('my-dashboard', [DashboardController::class, 'dashboard'])->name('my-dashboard');

    Route::get('update-profile', [DashboardController::class, 'update_profile'])->name('update-profile');
    Route::post('save-update-profile', [DashboardController::class, 'save_profile'])->name('save-update-profile');

    Route::get('change-password', [DashboardController::class, 'change_password'])->name('change-password');
    Route::post('save-change-password', [DashboardController::class, 'save_password'])->name('save-change-password');

    Route::post('common-ajaxcall', [CommonController::class, 'ajaxcall'])->name('common-ajaxcall');

    // Route::get('system-setting',[SystemsettingController::class,'system_setting'])->name('system-setting');
    // Route::post('save-system-setting',[SystemsettingController::class,'system_setting'])->name('save-system-setting');

    Route::get('smtp-setting',[SmtpsettingController::class,'smtp_setting'])->name('smtp-setting');
    Route::post('save-smtp-setting',[SmtpsettingController::class,'save_setting'])->name('save-smtp-setting');
    
    $adminPrefix = "audittrails";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('audit-trails', [AuditTrailsController::class, 'list'])->name('audit-trails');
        Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    });


});

?>