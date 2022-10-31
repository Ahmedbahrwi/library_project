<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books',[ApiBookController::class,'index']);
Route::get('/books/show/{id}',[ApiBookController::class,'show']);

//login/register
Route::post('/handel-login',[ApiAuthController::class,'handelLogin']);
Route::post('/handel-register',[ApiAuthController::class,'handleRegister']);
Route::post('/logout',[ApiAuthController::class,'logout']);
Route::middleware('IsApiUser')->group(function(){
Route::post('/books/store',[ApiBookController::class,'store']);
Route::post('/books/update/{id}',[ApiBookController::class,'update']);
Route::get('/books/delete/{id}',[ApiBookController::class,'delete']);

});