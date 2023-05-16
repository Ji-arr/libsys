<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\HomeController;

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
/*
Route::get('/', function() {
    return view('try.try');
});
*/
Route::middleware('auth', 'isAdmin')->group(function () {
    Route::get('/', 'App\Http\Controllers\PagesController@index');
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index');
    Route::get('/returnbooks', 'App\Http\Controllers\PagesController@returnbooks');
    Route::resource('books', BookController::class);
    Route::resource('accounts', HomeController::class);
    Route::get('books.delete/{id}', 'App\Http\Controllers\BookController@delete');
    Route::resource('/issuebooks', BorrowerController::class);
    Route::get('/students', 'App\Http\Controllers\StudentsController@index');
    Route::get('books.show','App\Http\Controllers\StudentsController@getStudents')->name('students.getStudents');
    Route::get('/search', 'App\Http\Controllers\BookController@search');
    Route::get('/adminsearch', 'App\Http\Controllers\BookController@adminsearch')->name('adminSearch');
    Route::get('/book-management', 'App\Http\Controllers\BookController@bookmanagement');
    Route::get('/returnbooks', 'App\Http\Controllers\BorrowerController@approvedBorrower');
    Route::put('/returnbooks/{id}', 'App\Http\Controllers\BorrowerController@returnUpdate');


});

Route::middleware('auth')->group(function () {
    Route::resource('/issuebooks',  BorrowerController::class);
    Route::resource('/books', BookController::class);
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index');
});

Route::get('/search', 'App\Http\Controllers\BookController@search');
Route::resource('/books', BookController::class);
Route::get('/', 'App\Http\Controllers\PagesController@index');

Auth::routes();


