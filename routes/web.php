<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResultController;

Route::get('/', [ResultController::class, 'index']);
Route::get('/demo1', [ResultController::class, 'demo1']);
Route::post('/individual-result', [ResultController::class, 'fetchIndividual'])->name('individual.result');
Route::get('/group-result', [ResultController::class, 'fetchGroup'])->name('group.result');