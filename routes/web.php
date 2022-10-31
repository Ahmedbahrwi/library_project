<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//books:read
Route::get('/books', [BookController::class,'index'])->name('get.index');
Route::get('/books/show/{id}', [BookController::class,'show'])->name('get.show');
Route::get('/books/search', [BookController::class,'search'])->name('get.search');
//books:create

//categories:read
Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
Route::get('/categories/show/{id}', [CategoryController::class,'show'])->name('category.show');
//categories:create
Route::get('/categories/create', [CategoryController::class,'create'])->name('category.create');
Route::post('/categories/store', [CategoryController::class,'store'])->name('categor.create');
//categories:update
Route::get('/categories/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
Route::post('/categories/update/{id}', [CategoryController::class,'update'])->name('category.update');


Route::middleware('isLogin')->group(function(){
Route::get('/books/create', [BookController::class,'create'])->name('get.create');
Route::post('/books/store', [BookController::class,'store'])->name('post.create');
//books:update
Route::get('/books/edit/{id}', [BookController::class,'edit'])->name('get.edit');
Route::post('/books/update/{id}', [BookController::class,'update'])->name('post.update');
//notes:create
Route::get('/notes/create',[NoteController::class,'create'])->name('notes.create');
Route::post('/notes/store',[NoteController::class,'store'])->name('notes.store');

});
Route::middleware('isNotLogin')->group(function(){
    //register
Route::get('/register', [AuthController::class,'register'])->name('auth.register');
Route::post('/handle-register', [AuthController::class,'handleRegister'])->name('auth.handleRegister');
//login
Route::get('/login', [AuthController::class,'login'])->name('auth.login');
Route::post('/handle-login', [AuthController::class,'handleLogin'])->name('auth.handleLogin');

});
Route::middleware('isLoginAdmin')->group(function(){
    //books:delete
Route::get('/books/delete/{id}', [BookController::class,'delete'])->name('get.delete');
//categories:delete
Route::get('/categories/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');


});
Route::get('login/github', [AuthController::class,'redirectToProvider'])->name('auth.github.redirect');
Route::get('login/github/callback', [AuthController::class,'handleProviderCallback'])->name('auth.github.callback');




