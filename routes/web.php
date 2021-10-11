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

Route::post('/simpanData', 'Biodata@create');
Route::get('/hapusData/{id}', 'Biodata@delete');
Route::post('/updateData', 'Biodata@update');
Route::get('/readData', 'Biodata@read');
Route::get('/detail/{id}', 'Biodata@readDetail');
