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

Route::get('/', function () {
    return view('pages.home');
});


Route::resource('orgs', 'OrgsController');
Route::get('orgs/{id}/delete', 'OrgsController@destroy');

Route::post('orgs/{id}/documents', 'DocumentsController@store');
Route::get('document/{id}/delete', 'DocumentsController@destroy');
Route::get('document/{id}', 'DocumentsController@download');

Route::post('orgs/{id}/links', 'LinksController@store');
Route::get('link/{id}/delete', 'LinksController@destroy');

Route::post('orgs/{id}/contacts', 'ContactsController@store');
Route::get('contact/{id}/delete', 'ContactsController@destroy');

//Route::get('orgs/create', 'OrgsController@create');

// Route::post('orgs', 'OrgsController@store');

// Route::get('orgs/{id}', 'OrgsController@show');

// Route::get('orgs/{id}/edit', 'OrgsController@edit');

// Route::patch('orgs/{id}', 'OrgsController@update');

// Route::delete('orgs/{id}', 'OrgsController@destroy');


Route::auth();

Route::get('/home', 'HomeController@index');
