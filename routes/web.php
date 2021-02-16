<?php


use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@getHome');


Route::get('catalog','CatalogController@getIndex')->middleware('auth');


Route::get('catalog/show/{id}','CatalogController@getShow')->middleware('auth');


Route::get('catalog/create','CatalogController@getCreate')->middleware('auth');
	
	
Route::get('catalog/edit/{id}','CatalogController@getEdit')->middleware('auth');


Auth::routes(); 

Route::get('/home', 'HomeController@index')->name('home');

Route::post('catalog/create', 'CatalogController@postCreate')->middleware('auth');

Route::put('catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');

Route::get('login/github', 'Auth\LoginController@redirectToProvider');


Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/files', 'FileController@index')->name('files.index')->middleware('auth');;
Route::post('/files', 'FileController@store')->name('files.store')->middleware('auth');;
Route::delete('/files/{file}', 'FileController@destroy')->name('files.destroy')->middleware('auth');;
Route::get('/files/{file}/download', 'FileController@download')->name('files.download')->middleware('auth');;