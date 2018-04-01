<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
use Illuminate\Support\Facades\Auth;

Route::get('/', "IndexController@getIndexPage")->name('index');

Route::get('/eula', "IndexController@eula")->name('eula');

Route::get('/afterLogin', "IndexController@afterLogin")->name('afterLogin');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', "DashboardController@index")->name('dashboard');

    Route::resource('/participants', "ParticipantController");
    Route::resource('/organizers', "OrganizerController");

});