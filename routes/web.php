<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',  [HomeController::class, 'index']);
Route::get('/getdoctors',  [HomeController::class, 'getdoctors'])->name('getdoctors');;
Route::get('/getworkingdays',  [HomeController::class, 'getworkingdays'])->name('getworkingdays');;
