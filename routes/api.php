<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('getListBooks', 'APITrainee\APITraineeController@listBooks');
Route::post('getPdfLink', 'APITrainee\APITraineeController@pdfLink');
Route::get('checkDataSync', 'APITrainee\APITraineeController@dataSync');
Route::get('getEmployee', 'APITrainee\APITraineeController@employee');
Route::get('/', 'APITrainee\APITraineeController@index');

Route::post('/registerDeviceTokenForUser', 'APITrainee\PushNotificationController@registerDeviceTokenForUser');
Route::post('/registerdevicetokenforuser', 'APITrainee\PushNotificationController@registerDeviceTokenForUser');

