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
Route::post('auth/register', 'Auth\AuthController@postUserRegister');
Route::get('register/verify/{confirmationCode}','Auth\AuthController@confirm');
Route::post('user/check_email','UserController@check_email');
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//User routes
Route::group(['prefix' => 'user'],function()
{
    Route::get('login','UserController@login' );
    Route::post('login', 'UserController@authenticate');
    Route::get('confirmation_code/{id}', 'UserController@confirmation_code');
    Route::get('/', ['middleware' => 'user', 'uses'=>'UserController@index']);
    Route::get('{id}/edit', ['middleware' => 'user', 'uses'=>'UserController@edit']);
    Route::post('save', ['middleware' => 'user', 'uses'=>'UserController@save']);

    //Childrens routes
    Route::get('childrens', ['middleware' => 'user', 'uses'=>'ChildrenController@index'] );
    Route::get('childrens/create', ['middleware' => 'user', 'uses'=>'ChildrenController@create'] );
    Route::get('childrens/{id}/edit', ['middleware' => 'user', 'uses'=>'ChildrenController@edit'] );
    Route::get('childrens/{id}/edit_form', ['middleware' => 'user', 'uses'=>'ChildrenController@edit_form'] );
    Route::post('childrens/save', ['middleware' => 'user', 'uses'=>'ChildrenController@save'] );
    Route::any('childrens/{id}/delete', ['middleware' => 'user', 'uses'=>'ChildrenController@destroy'] );
});

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
    Route::get('logout', 'Auth\AuthController@getLogout');

    //Programs routes
    Route::get('programs', ['middleware' => 'admin', 'uses'=>'ProgramController@index'] );
    Route::get('programs/create', ['middleware' => 'admin', 'uses'=>'ProgramController@create'] );
    Route::get('programs/{id}/edit', ['middleware' => 'admin', 'uses'=>'ProgramController@edit'] );
    Route::post('programs/save', ['middleware' => 'admin', 'uses'=>'ProgramController@save'] );
    Route::any('/programs/publish/{id}', ['middleware' => 'admin', 'uses'=>'ProgramController@publish'] );
    Route::any('/programs/unpublish/{id}', ['middleware' => 'admin', 'uses'=>'ProgramController@unpublish'] );
    Route::any('programs/{id}/delete', ['middleware' => 'admin', 'uses'=>'ProgramController@destroy'] );
    //News routes
    Route::get('news', ['middleware' => 'admin', 'uses'=>'NewsController@index'] );
    Route::get('news/create', ['middleware' => 'admin', 'uses'=>'NewsController@create'] );
    Route::get('news/{id}/edit', ['middleware' => 'admin', 'uses'=>'NewsController@edit'] );
    Route::post('news/save', ['middleware' => 'admin', 'uses'=>'NewsController@save'] );
    Route::any('news/{id}/delete', ['middleware' => 'admin', 'uses'=>'NewsController@destroy'] );
    Route::any('/news/publish/{id}', ['middleware' => 'admin', 'uses'=>'NewsController@publish'] );
    Route::any('/news/unpublish/{id}', ['middleware' => 'admin', 'uses'=>'NewsController@unpublish'] );
    Route::any('/news/{id}/delete', ['middleware' => 'admin', 'uses'=>'NewsController@destroy'] );

});