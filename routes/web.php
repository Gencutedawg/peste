<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Operator\WeightTestingController;
use App\Http\Controllers\Operator\ThicknessTestingController;
use App\Http\Controllers\Operator\WeightAlarmController;
use App\Http\Controllers\Operator\ThicknessAlarmController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsOperator; 


Route::get('/', function () {
    return redirect('/login');
});

//only for user route
Route::middleware(['auth', IsOperator::class, \App\Http\Middleware\ValidateSessionRole::class])->group(function () {
        Route::get('/dashboard', function () {
        return view('dashboard');
        })->name('dashboard');

        // Testing Routes
        Route::prefix('testing')->name('testing.')->group(function () {
                Route::get('weight', [WeightTestingController::class, 'index'])->name('weight');
                Route::post('weight', [WeightTestingController::class, 'store'])->name('weight.store');
                Route::get('thickness', [ThicknessTestingController::class, 'index'])->name('thickness');
                Route::post('thickness', [ThicknessTestingController::class, 'store'])->name('thickness.store');
                Route::get('moisture', function () {
                        return view('operator.testing.moisture');
                })->name('moisture');
        });

        // SPC Alarm Routes
        Route::prefix('alarm')->name('alarm.')->group(function () {
                Route::get('weight', [WeightAlarmController::class, 'weight'])->name('weight');
                Route::get('thickness', [ThicknessAlarmController::class, 'thickness'])->name('thickness');
                Route::get('moisture', function () {
                        return view('operator.alarm.moisture');
                })->name('moisture');
        });

});

//only for admin route
Route::middleware(['auth', 'verified', IsAdmin::class, \App\Http\Middleware\ValidateSessionRole::class])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])
        ->name('admin.dashboard');
        
        // User Management Routes
        Route::prefix('admin/users')->name('users.')->controller(\App\Http\Controllers\Admin\UserController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{user}/edit', 'edit')->name('edit');
                Route::put('{user}', 'update')->name('update');
                Route::delete('{user}', 'destroy')->name('destroy');
        });

        // Plate Management Routes
        Route::prefix('admin/plates')->name('plates.')->controller(\App\Http\Controllers\Admin\PlateSpecificationController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{plate}/edit', 'edit')->name('edit');
                Route::put('{plate}', 'update')->name('update');
                Route::delete('{plate}', 'destroy')->name('destroy');
        });
});









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
