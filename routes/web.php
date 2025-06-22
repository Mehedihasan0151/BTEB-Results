<?php
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckPassword;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\BombingController;

Route::get('/', [ResultController::class, 'index']);
Route::get('/test1', [ResultController::class, 'index1']);
Route::get('/test2', [ResultController::class, 'index2']);
Route::get('/individual-result', [ResultController::class, 'fetchIndividual'])->name('individual.result');
Route::get('/group-result', [ResultController::class, 'fetchGroup'])->name('group.result');



Route::get('/password', [BombingController::class, 'showPasswordForm']);
Route::post('/password', [BombingController::class, 'handlePassword']);

Route::middleware([CheckPassword::class])->group(function () {
    Route::get('/call', [BombingController::class, 'showForm']);
    Route::post('/send-call', [BombingController::class, 'sendCall']);
});