<?php

use Illuminate\Support\Facades\Route;

// Email Database
Route::get('api/v1/brands/{account_id}/onboarding/files/emaildatabase', 'EmaildatabaseController@index');
//Route::get('api/v1/brands/{account_id}/onboarding/files/emaildatabase', 'EmaildatabaseController@getEmaildatabase');
Route::post('api/v1/brands/{account_id}/onboarding/files/emaildatabase', 'EmaildatabaseController@saveEmaildatabase');

// Key player list
Route::get('api/v1/brands/{account_id}/onboarding/files/keyplayerlist', 'EmaildatabaseController@getKeyplayerlist');
Route::post('api/v1/brands/{account_id}/onboarding/files/keyplayerlist', 'EmaildatabaseController@saveKeyplayerlist');

