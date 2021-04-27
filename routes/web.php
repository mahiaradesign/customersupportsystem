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
Route::get('/query', 'TicketsController@index');

// to submit the query and mail the query
Route::post('/ticketSubmit','TicketsController@save');

// for executive login and logout
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@loginFinal');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// moving to the home page of the executive 
Route::get('/home','HomeController@index' );

// Route for executive assigned tasks
Route::get('/executive/assigned_tasks','HomeController@tasks' )->name('executive.assigned_tasks');
// Route for executive reply
Route::get('/executive/reply/{ticket_id}', 'ResponsesController@reply')->name('executive.reply.ticket_id');

// ROUTE FOR SENDING MAIL {use it to send mail from the executive to the author with ticket id = ticket_id} 
// Use ticket_id from table 
Route:: post('/executive/sendEmail/{ticket_id}','ResponsesController@sendEmail')->name('executive.sendEmail.ticket_id');

// for admins only
Route::group(['middleware' => ['auth']], function () { 
Route::get('/admin', 'AdminController@index');
});

// to register the executive
Route::group(['middleware' => ['auth']], function () { 
    Route::get('/admin/add_register', 'AdminController@registerExec');
});
Route::post('/admin/add_register', 'AdminController@storeExec')->name('add_exe');
// Route::get('/admin/all_executive', function () {
//     return view('/admin/all_executive');
// });
Route::get('/admin/all_executive','AdminController@all_executive');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
