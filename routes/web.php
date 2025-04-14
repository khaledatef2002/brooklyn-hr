<?php

use App\Http\Controllers\Front\JobApplicationsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

require_once __DIR__ . '/dashboard.php';
require_once __DIR__ . '/auth.php';

Route::name('front.')->prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function(){
    Route::get('apply', [JobApplicationsController::class, 'index'])->name('apply');
    Route::post('apply', [JobApplicationsController::class, 'store'])->name('apply');
});