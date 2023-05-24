<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sashagm\Notification\Http\Controllers\NotificationController;


Route::post('/notifications', [NotificationController::class, 'send'])->name('nf');
