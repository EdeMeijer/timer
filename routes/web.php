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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/entry/create', 'HomeController@createEntry')->name('entry.create');
Route::post('/entry/stop', 'HomeController@stopCurrentEntry')->name('entry.stopCurrent');
Route::delete('/entry/{id}', 'HomeController@deleteEntry')->name('entry.delete');


Route::get('/tags', 'TagsController@index')->name('tags');
Route::post('/tag/create', 'TagsController@createTag')->name('tag.create');
Route::delete('/tag/{id}', 'TagsController@deleteTag')->name('tag.delete');
