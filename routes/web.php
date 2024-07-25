<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('contacts', ContactController::class);
Route::get('import', [ContactController::class, 'importView'])->name('import');
Route::post('import', [ContactController::class, 'import'])->name('contacts.import');
