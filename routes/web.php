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

//use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('formulario');
});

// NOVO CADASTRO
Route::post('/new', 'ContatosController@insert');

// BUSCA TODOS OS REGISTROS
Route::get('/findAll', 'ContatosController@findAll');

// BUSCA REGISTRO ESPECIFICO
Route::get('/findBy/{id}', 'ContatosController@findBy');
