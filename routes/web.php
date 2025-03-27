<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', function () {
    return view('welcome');
})->name('welcome');

Route::post('register', [
    AuthController::class,
    'register',
])->name('register');

Route::middleware('availableLink')
    ->prefix('{userLink}')
    ->as('userLink.')
    ->group(function () {
        Route::get('', [
            UserLinkController::class,
            'show',
        ])->name('show');
        Route::post('generate-link', [
            UserLinkController::class,
            'generateLink',
        ])->name('generateLink');
        Route::post('deactivate-link', [
            UserLinkController::class,
            'deactivateLink',
        ])->name('deactivateLink');
        Route::post('imfeelinglucky', [
            UserLinkController::class,
            'imfeelinglucky',
        ])->name('imfeelinglucky');
        Route::get('history', [
            UserLinkController::class,
            'history',
        ])->name('history');
    });
