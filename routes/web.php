<?php

use Illuminate\Support\Facades\Route;
use Pages\Http\Controllers\PageController;

// Route::get('{url}', [PageController::class, 'handle'])->where('url', '.*');
Route::get('{lang}/{url}', [PageController::class, 'handle'])->where('url', '.*');