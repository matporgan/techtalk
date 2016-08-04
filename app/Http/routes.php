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

// Home
Route::get('/', 'PagesController@home');

// Authentication
Route::auth();

// Organisations
Route::get('discover', 'OrgsController@index');
Route::resource('orgs', 'OrgsController');
Route::get('orgs/{id}/delete', 'OrgsController@destroy');
//Route::post('orgs/{id}/adduser', 'OrgsController@addUser');

// Organisation users
Route::post('orgs/{id}/contributor', 'ContributorsController@store');
Route::get('orgs/{id}/contributor/{user_id}/delete', 'ContributorsController@destroy');
Route::get('orgs/{id}/watch', 'ContributorsController@watch');
Route::get('orgs/{id}/unwatch', 'ContributorsController@unwatch');

// Organisation documents
Route::post('orgs/{id}/document', 'DocumentsController@store');
Route::patch('orgs/{id}/document/{document_id}/update', 'DocumentsController@update');
Route::get('orgs/{id}/document/{document_id}/delete', 'DocumentsController@destroy');
Route::get('orgs/{id}/document/{document_id}', 'DocumentsController@download');

// Organisation links
Route::post('orgs/{id}/link', 'LinksController@store');
Route::patch('orgs/{id}/link/{link_id}/update', 'LinksController@update');
Route::get('orgs/{id}/link/{link_id}/delete', 'LinksController@destroy');

// Organisation contacts
Route::post('orgs/{id}/contact', 'ContactsController@store');
Route::patch('orgs/{id}/contact/{contact_id}/update', 'ContactsController@update');
Route::get('orgs/{id}/contact/{contact_id}/delete', 'ContactsController@destroy');

// Misc Pages
Route::get('technology/{technology_id}', 'PagesController@technology');
Route::get('industry/{industry_id}', 'PagesController@industry');
Route::get('domain/{domain_id}', 'PagesController@domain');
Route::get('tag/{tag_id}', 'PagesController@tag');
Route::get('user/{user_id}/orgs', 'PagesController@userOrgs');
Route::get('user/{user_id}/discussions', 'PagesController@userDiscussions');

// User preferences
Route::get('account', 'PreferencesController@show');
Route::post('account/notify', 'PreferencesController@updateNotify');
Route::post('account/password', 'PreferencesController@updatePassword');

// Discussions
Route::get('discuss', 'DiscussionsController@index');
//Route::get('discussions', 'DiscussionsController@index');
Route::get('discussions/create', 'DiscussionsController@create');
Route::get('discussions/{discussion_id}', 'DiscussionsController@show');
Route::post('discussions', 'DiscussionsController@store');

// Comments
Route::post('discussions/{discussion_id}/comment/{parent_id}', 'CommentsController@store');
Route::post('comment/{comment_id}/update', 'CommentsController@update');
Route::get('comment/{comment_id}/delete', 'CommentsController@destroy');

// Search
Route::post('discuss/search', 'SearchController@discussions');
Route::post('discover', 'SearchController@orgs');
Route::get('discover/search', 'SearchController@continue');

// Test
Route::get('test', 'TestController@start');