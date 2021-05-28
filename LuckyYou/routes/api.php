<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
Route::post('update', 'ProfileController@update');
Route::get('profile', 'ProfileController@profile');

Route::apiResource('users', 'UserController');

Route::get('achievements', 'AchievementsController@achievements');
Route::get('user-achievements', 'AchievementsController@userAchievements');

Route::post('update-user-achievement', 'AchievementsController@updateUserAchievement');
Route::post('userDelete', 'UserController@destroy');

Route::post('giveMoney', 'UserController@giveMoney');
Route::post('changeRole', 'UserController@changeRole');
Route::get('updateuser', 'UserController@user');

Route::post('checkAchiev', 'AchievementsController@checkAchiev');
Route::get('gethistory', 'HistoryController@history');
Route::get('userwinningshistory', 'HistoryController@userwinningshistory');

Route::get('getlobbies', 'GamesController@lobbies');
Route::post('stake', 'GamesController@stake');



