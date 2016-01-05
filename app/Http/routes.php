<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'IndexController@index');
Route::get('home', function()
{
    return Redirect::to('/');
});

// Authentication Routes...
Route::get('logout', 'Auth\AuthController@getLogout');


// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Admin routes
Route::group(['prefix' => 'admin'],function()
{
    Route::get('/', ['middleware' => 'admin', 'uses'=>'AdminController@index'] );
    Route::get('dashboard',['middleware' => 'admin', 'uses'=>'AdminController@index']);

    Route::get('login','AdminController@login' );
    Route::post('login', 'AdminController@authenticate');
    Route::get('changepass',  ['middleware' => 'admin', function(){
        $message="";
        return view('admin.changepass')->with('message',$message);
    }]);
    Route::post('changepass',  ['middleware' => 'admin', 'uses'=>'AdminController@changepass']);
//Programs routes
    Route::get('programs', ['middleware' => 'admin', 'uses'=>'ProgramController@index'] );
    Route::get('programs/create', ['middleware' => 'admin', 'uses'=>'ProgramController@create'] );
    Route::get('programs/{id}/edit', ['middleware' => 'admin', 'uses'=>'ProgramController@edit'] );
    Route::post('programs/save', ['middleware' => 'admin', 'uses'=>'ProgramController@save'] );
//news routes
    Route::get('news', ['middleware' => 'admin', 'uses'=>'NewsController@index'] );
    Route::get('news/create', ['middleware' => 'admin', 'uses'=>'NewsController@create'] );
    Route::get('logout', 'Auth\AuthController@getLogout');

});