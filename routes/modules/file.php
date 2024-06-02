<?php

declare(strict_types=1);

use App\Http\Controllers\Api\FilesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'file'], function () {
    Route::get('', [FilesController::class, 'index'])->name('file-list');
    Route::post('', [FilesController::class, 'storeFile'])->name('file-store');
});
