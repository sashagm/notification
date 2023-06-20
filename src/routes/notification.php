<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sashagm\Notification\Http\Controllers\NotificationController;


Route::post(config('nf.url'), [NotificationController::class, 'send'])->name(config('nf.routeName'));
