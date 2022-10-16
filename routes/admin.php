<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;
use App\Http\Controllers\backend\admin\quiz\QuiztypeController;
use App\Http\Controllers\backend\admin\quiz\QuizcategoryController;
use App\Http\Controllers\backend\admin\quiz\QuizController;
use App\Http\Controllers\backend\admin\quiz\QuestionController;
use App\Http\Controllers\backend\CommonController;

Route::get('/admin-logout', [LoginController::class, 'logout'])->name('admin-logout');
Route::post('common-ajaxcall', [CommonController::class, 'ajaxcall'])->name('common-ajaxcall');

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

$prefix = 'quiz';
Route::group(['prefix' => $prefix, 'middleware' => ['admin']], function() {
    // quiz-type

    Route::get('quiz-type-list', [QuiztypeController::class, 'list'])->name('quiz-type-list');
    Route::get('quiz-type-add', [QuiztypeController::class, 'add'])->name('quiz-type-add');
    Route::post('save-quiz-type-add', [QuiztypeController::class, 'save_add_quiz_type'])->name('save-quiz-type-add');
    Route::get('quiz-type-edit/{id}', [QuiztypeController::class, 'edit'])->name('quiz-type-edit');
    Route::post('save-quiz-type-edit', [QuiztypeController::class, 'save_edit_quiz_type'])->name('save-quiz-type-edit');
    Route::post('quiz-type-ajaxcall', [QuiztypeController::class, 'ajaxcall'])->name('quiz-type-ajaxcall');

    Route::get('quiz-category-list', [QuizcategoryController::class, 'list'])->name('quiz-category-list');
    Route::get('quiz-category-add', [QuizcategoryController::class, 'add'])->name('quiz-category-add');
    Route::post('save-quiz-category-add', [QuizcategoryController::class, 'save_add_quiz_category'])->name('save-quiz-category-add');
    Route::get('quiz-category-edit/{id}', [QuizcategoryController::class, 'edit'])->name('quiz-category-edit');
    Route::post('save-quiz-category-edit', [QuizcategoryController::class, 'save_edit_quiz_category'])->name('save-quiz-category-edit');
    Route::post('quiz-category-ajaxcall', [QuizcategoryController::class, 'ajaxcall'])->name('quiz-category-ajaxcall');

    Route::get('quiz-list', [QuizController::class, 'list'])->name('quiz-list');
    Route::get('quiz-add', [QuizController::class, 'add'])->name('quiz-add');
    Route::post('save-quiz-add', [QuizController::class, 'save_add_quiz'])->name('save-quiz-add');
    Route::get('quiz-edit/{id}', [QuizController::class, 'edit'])->name('quiz-edit');
    Route::post('save-quiz-edit', [QuizController::class, 'save_edit_quiz'])->name('save-quiz-edit');
    Route::get('quiz-view/{id}', [QuizController::class, 'view'])->name('quiz-view');
    Route::post('quiz-ajaxcall', [QuizController::class, 'ajaxcall'])->name('quiz-ajaxcall');

    Route::get('quiz-add-question/{quiz_id}', [QuestionController::class, 'add'])->name('quiz-add-question');
    Route::post('save-quiz-question-add', [QuestionController::class, 'save_add_quiz_question'])->name('save-quiz-question-add');
    Route::get('quiz-edit-question/{quiz_id}', [QuestionController::class, 'edit'])->name('quiz-edit-question');
    Route::post('save-quiz-question-edit', [QuestionController::class, 'save_edit_quiz_question'])->name('save-quiz-question-edit');
    Route::post('quiz-question-ajaxcall', [QuestionController::class, 'ajaxcall'])->name('quiz-question-ajaxcall');



});
?>
