<?php
use App\Http\Controllers\ResultController;

Route::get('/', [ResultController::class, 'index']);
Route::get('/individual-result', [ResultController::class, 'fetchIndividual'])->name('individual.result');
Route::get('/group-result', [ResultController::class, 'fetchGroup'])->name('group.result');
