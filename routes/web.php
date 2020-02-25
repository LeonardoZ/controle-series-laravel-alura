<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/series', 'SeriesController@index')
    ->name('series_listar');
Route::get('/series/criar', 'SeriesController@create')
    ->name('series_criar')
    ->middleware('autenticador');
Route::post('/series/criar', 'SeriesController@store')
    ->name('series_salvar')
    ->middleware('autenticador');
Route::delete('/series/remover/{id}', 'SeriesController@destroy')
     ->name('series_remover')
     ->middleware('autenticador');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index')
    ->name('lista-series-temporadas')
    ->middleware('autenticador');
Route::post('/series/{serieId}/editaNome', 'SeriesController@editaNome')
    ->name('series_update')
    ->middleware('autenticador');
Route::get('/temporadas/{temporadaId}/episodios', 'EpisodiosController@index')
    ->name('temporada_episodios')
    ->middleware('autenticador');
Route::post('/temporada/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador')
    ->name('episodios_assistidos');

//autenticador::routes()->middleware('autenticador');
Route::get('/home', 'HomeController@index')->name('home')->middleware('autenticador');

// Login Custo->middleware('auth');
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});