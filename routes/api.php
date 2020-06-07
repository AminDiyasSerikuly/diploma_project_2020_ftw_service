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

//Used for Firebase auth

Route::get('/me', function (Request $request) {
    return (array) $request->user();
})->middleware('auth:api');

//End of Firebase



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/pusher/beams-auth', function (Request $request) {
    $userID = $request->user()->id; // If you use a different auth system, do your checks here
    $userIDinQueryParam = Input::get('user_id');

    if ($userID != $userIDinQueryParam) {
        return response('Inconsistent request', 401);
    } else {
        $beamsToken = $beamsClient->generateToken($userID);
        return response()->json($beamsToken);
    }
});