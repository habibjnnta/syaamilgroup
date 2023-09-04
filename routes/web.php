<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('login');
});

Route::get('/token', function (Request $request) {
    return response()->json([
        "token" => csrf_token()
    ]);
})->name('token');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function () {
        // Dashboard
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        // Barang
        Route::resource('barang', 'BarangController');
        // Perusahaan
        Route::resource('perusahaan', 'PerusahaanController');
        // Transaksi
        Route::resource('transaksi', 'TransaksiController');
        // Export Excel
        Route::get('export/{id}', 'TransaksiController@export')->name('export');
    });
});
