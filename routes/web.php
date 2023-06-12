<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\domainController;


Route::get('/', [domainController::class,"listazas"])->name('listazas');
Route::get('/domain-rogzites',[domainController::class,"domainForm"])->name("domainRogzites");
Route::post('/domain-rogzites',[domainController::class,"domainRogzites"]);