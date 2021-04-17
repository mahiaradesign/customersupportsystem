<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('index');
});
// to visit the query page
Route::get('/query', 'App\Http\Controllers\TicketsController@index');

// to submit the query
Route::post('/ticketSubmit','App\Http\Controllers\TicketsController@save');

// for executive login and logout
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@authenticate');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// moving to the home page of the executive 
Route::get('/home','App\Http\Controllers\HomeController@index' );

// ROUTE FOR SENDING MAIL {use it to send mail from the executive to the author with ticket id = ticket_id} 
// Use ticket_id from table 
Route:: get('sendEmail/{ticket_id}','App\Http\Controllers\ResponsesController@sendEmail');