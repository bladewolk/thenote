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
    echo phpinfo();
    exit();
    return redirect()->route('notes.index');
});

Route::resource('/notes', 'HomeController', ['except' => 'show']);
Route::get('/notes/export', 'ExportController@index')->name('export');
Route::post('/notes/export', 'ExportController@export')->name('export.do');
Route::get('/notes/import', 'ImportController@index')->name('import');
Route::post('/notes/import', 'ImportController@import')->name('import.do');