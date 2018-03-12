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
    return redirect('checker');
});
Route::get('checker', 'CheckerController@index')->name('checker');
Route::post('checker', 'CheckerController@create')->name('checker.create');

Route::get('test1', function () {
    return response('foo');
})->name('test1');

Route::get('test2', function () {
    return response('bar');
})->name('test2');

Auth::routes();
