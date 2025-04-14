<?php

use App\Helpers\select2;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\JobApplicationsController;
use App\Http\Controllers\Dashboard\NotificationsController;
use App\Http\Controllers\dashboard\SystemSettingsController;
use App\Http\Controllers\Dashboard\TaskMessagesController;
use App\Http\Controllers\Dashboard\TasksController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::name('dashboard.')->prefix(LaravelLocalization::setLocale() . '/dashboard')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::resource('users', UserController::class)->except('show');

    Route::resource('job-applications', JobApplicationsController::class);

    Route::put('job-applications/{job_application}/accept', [JobApplicationsController::class, 'accept']);
    Route::put('job-applications/{job_application}/reject', [JobApplicationsController::class, 'reject']);

    Route::get('job-application/{job_application}/print', [JobApplicationsController::class, 'print'])->name('job-applications.print');

    Route::controller(SystemSettingsController::class)->group(function(){
        Route::get('/system-settings', 'edit')->name('system-settings');
        Route::put('/system-settings', 'update')->name('system-settings');
    });

    Route::prefix('/select2')->controller(select2::class)->name('select2.')->group(function(){
        Route::get('/users', 'users')->name('users');
    });
});