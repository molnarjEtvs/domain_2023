<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\domainController;


Route::get('/', [domainController::class,"listazas"])->name('listazas');
Route::get('/domain-rogzites',[domainController::class,"domainForm"])->name("domainRogzites");
Route::post('/domain-rogzites',[domainController::class,"domainRogzites"]);
Route::post('/domain-torles-megerositese',[domainController::class,"domainTorlesMegerosites"]);
Route::post('/domain-torles',[domainController::class,"domainTorles"]);
Route::post('/domain-hosszabbitas-megerositese',[domainController::class,'hosszabbitasMegerosites']);
Route::post('/domain-hosszabbitas',[domainController::class,'domainHosszabbitas']);
Route::get('/domain-modositas/{domainId}',[domainController::class,'domainModositas'])->name('domainModositas');
Route::post('/domain-modositas/{domainId}',[domainController::class,'domainModositasMentes']);
