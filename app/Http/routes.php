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

Route::auth();

Route::resource('orgs', 'OrgsController');
Route::get('orgs/{id}/delete', 'OrgsController@destroy');
Route::post('orgs/{id}/adduser', 'OrgsController@adduser');

Route::post('orgs/{id}/documents', 'DocumentsController@store');
Route::get('orgs/{id}/document/{document_id}/delete', 'DocumentsController@destroy');
Route::get('orgs/{id}/document/{document_id}', 'DocumentsController@download');

Route::post('orgs/{id}/links', 'LinksController@store');
Route::get('orgs/{id}/link/{link_id}/delete', 'LinksController@destroy');

Route::post('orgs/{id}/contacts', 'ContactsController@store');
Route::get('orgs/{id}/contact/{contact_id}/delete', 'ContactsController@destroy');

Route::get('technology/{technology_id}', 'PagesController@technology');
Route::get('industry/{industry_id}', 'PagesController@industry');
Route::get('domain/{domain_id}', 'PagesController@domain');
Route::get('tag/{tag_id}', 'PagesController@tag');