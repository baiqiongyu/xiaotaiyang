<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LessonPlanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 留言板（需登录）
Route::middleware('auth')->group(function () {
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/my-messages', [ContactController::class, 'myMessages'])->name('contact.my-messages');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 教案生成
    Route::get('/lesson-plan', [LessonPlanController::class, 'index'])->name('lesson-plan.index');
    Route::post('/lesson-plan/generate', [LessonPlanController::class, 'generate'])->name('lesson-plan.generate');
});

require __DIR__.'/auth.php';
