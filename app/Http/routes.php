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

Route::post('orgs/{org_id}/documents', 'DocumentsController@store');
Route::get('orgs/{org_id}/document/{document_id}/delete', 'DocumentsController@destroy');
Route::get('orgs/{org_id}/document/{document_id}', 'DocumentsController@download');

Route::post('orgs/{org_id}/links', 'LinksController@store');
Route::get('orgs/{org_id}/link/{link_id}/delete', 'LinksController@destroy');

Route::post('orgs/{org_id}/contacts', 'ContactsController@store');
Route::get('orgs/{org_id}/contact/{contact_id}/delete', 'ContactsController@destroy');

Route::get('technology/{id}', 'PagesController@technology');
Route::get('industry/{id}', 'PagesController@industry');
Route::get('domain/{id}', 'PagesController@domain');


//Route::get('orgs/create', 'OrgsController@create');

// Route::post('orgs', 'OrgsController@store');

// Route::get('orgs/{id}', 'OrgsController@show');

// Route::get('orgs/{id}/edit', 'OrgsController@edit');

// Route::patch('orgs/{id}', 'OrgsController@update');

// Route::delete('orgs/{id}', 'OrgsController@destroy');


Route::auth();

Route::get('/home', 'HomeController@index');
