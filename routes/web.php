<?php

use Illuminate\Support\Facades\Route;

// Email Database
Route::get('api/v1/brands/{account_id}/onboarding/files/emaildatabase', 'GetOnBoardingController@getEmaildatabase');
Route::post('api/v1/brands/{account_id}/onboarding/files/emaildatabase', 'UploadOnBoardingController@saveEmaildatabase');
Route::delete('api/v1/brands/{account_id/onboarding/files/emaildatabase', 'DeleteOnBoardingController@deleteEmaildatabase');

// Key player list
Route::get('api/v1/brands/{account_id}/onboarding/files/keyplayerlist', 'GetOnBoardingController@getKeyplayerlist');
Route::post('api/v1/brands/{account_id}/onboarding/files/keyplayerlist', 'UploadOnBoardingController@saveKeyplayerlist');
Route::delete('api/v1/brands/{account_id/onboarding/files/keyplayerlist', 'DeleteOnBoardingController@deleteKeyplayerlist');
