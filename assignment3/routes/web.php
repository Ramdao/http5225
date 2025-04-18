<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;

Route::get('/', function () {
    return view('cats.index');
});

Route::get('/', [CatController::class, 'index']);
Route::resource('cats', CatController::class);