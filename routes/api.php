<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'IndexController@index');

Route::post('/detect', 'FaceController@detect');
Route::post('/identify', 'FaceController@identify');

Route::get('/trainingStatus', 'FaceController@trainingStatus');
Route::post('/startTraining', 'FaceController@startTraining');

Route::resource('/participant', 'ParticipantController');

Route::post('/participant/{id}/image', 'ParticipantImageController@upload');

Route::get('/participant/checkEmail/{email}', 'ParticipantController@isRegisteredEmail');