<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sashagm\Notification\Http\Controllers\NotificationController;



Route::group(['middleware' => ['web', 'check.access']], function () {

    Route::post(config('nf.url'), [NotificationController::class, 'send'])->name(config('nf.routeName'));
    
});