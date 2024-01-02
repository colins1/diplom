<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmsController;
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

Route::get('/hall', function () {
    return view('client.hall');
});

Route::get('/payment', function () {
    return view('client.payment');
});

Route::get('/ticket', function () {
    return view('client.ticket');
});

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::resource('/admin/index', FilmsController::class);

/*Route::get('/admin/index', function () {
    return view('admin.index');
});*/


