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

Route::get('/test/{id}', "TestController@test");

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', "DashboardController@index")->name('dashboard');

    Route::get('/participants/{id}/delete', "ParticipantController@destroy");
    Route::resource('/participants', "ParticipantController");
    Route::resource('/participant_images', "ParticipantImageController");
    Route::get('/organizers/{id}/delete', "OrganizerController@destroy");
    Route::get('/organizers/{id}/password', "OrganizerController@passwd_update")->name("password.update");
    Route::put('/organizers/{id}/password', "OrganizerController@passwd");
    Route::resource('/organizers', "OrganizerController");
    Route::resource('/groups', "GroupController");
    Route::get('/groups/{id}/delete', "GroupController@destroy");

    Route::resource('/log', "LogController");

});