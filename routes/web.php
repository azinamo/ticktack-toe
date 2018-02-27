<?php

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
Route::get('/', function () { return redirect('/home'); });


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->get('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'UserGameController@index')->name('play_game');

    Route::post('/save/state/{game_id}', 'UserGameController@saveGame')->name('save_game');

    Route::get('/history', 'UserGameController@history')->name('game_history');

    Route::get('/game', 'UserGameController@game')->name('load_game');

    Route::get('/continue/game/{game_id}', 'UserGameController@continueGame')->name('continue_game');

});