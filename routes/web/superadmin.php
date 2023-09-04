<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Superadmin section
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => 'permission:guru-view-any,guru-view'
], function(){
    Route::prefix('guru')->name('superadmin.guru.')->group(function () {
        Route::get('/', function () {
            // Matches The "/orangtua/login" URL
            return view('layouts.admin.index');
        })->name('index');
    });
});