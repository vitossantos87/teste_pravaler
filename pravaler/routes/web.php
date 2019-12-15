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

Route::get('/teste-logica-1', 'TesteLogica1Controller@index')->name('teste1');
Route::get('/teste-logica-2', 'TesteLogica2Controller@index')->name('teste2');

#rotas do sistema de autenticacao
Auth::routes(['register' => false]);

#rotas do sistema SIGIE
Route::prefix('sigie')->middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
