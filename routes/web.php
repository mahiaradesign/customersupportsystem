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

Route::get('/', function () {
    return view('index');
});

// to visit the query page
Route::get('/query', 'App\Http\Controllers\TicketsController@index');

// to submit the query and mail the query
Route::post('/ticketSubmit','App\Http\Controllers\TicketsController@save');

// for executive login and logout
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@authenticate');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// moving to the home page of the executive 
Route::get('/home','App\Http\Controllers\HomeController@index' );

// Route for executive assigned tasks
Route::get('/executive/assigned_tasks/{id}','App\Http\Controllers\HomeController@tasks' )->name('executive.assigned_tasks.id');
// Route for executive reply
Route::get('/executive/reply/{ticket_id}', 'App\Http\Controllers\ResponsesController@reply');

// ROUTE FOR SENDING MAIL {use it to send mail from the executive to the author with ticket id = ticket_id} 
// Use ticket_id from table 
Route:: post('/executive/sendEmail/{ticket_id}','App\Http\Controllers\ResponsesController@sendEmail')->name('executive.sendEmail.ticket_id');

// for admins only
Route::get('/admin', 'App\Http\Controllers\AdminController@index');

Route::get('/admin/add_executive', function () {
    return view('/admin/add_executive');
});
Route::get('/admin/all_executive', function () {
    return view('/admin/all_executive');
});

// to register the executive
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store');
