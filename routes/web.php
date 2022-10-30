<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix'=>'atores', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('', ['as'=>'atores', 'uses'=>'AtoresController@index']);
        Route::get('create', ['as'=>'atores.create', 'uses'=>'AtoresController@create']);
        Route::get('destroy', ['as'=>'atores.destroy', 'uses'=>'AtoresController@destroy']);
        Route::get('edit', ['as'=>'atores.edit', 'uses'=>'AtoresController@edit']);
        Route::put('{id}/update', ['as'=>'atores.update', 'uses'=>'AtoresController@update']);
        Route::post('store', ['as'=>'atores.store', 'uses'=>'AtoresController@store']);
    
    });
    
    Route::group(['prefix'=>'nacionalidades', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('', ['as'=>'nacionalidades', 'uses'=>'NacionalidadesController@index']);
        Route::get('create', ['as'=>'nacionalidades.create', 'uses'=>'NacionalidadesController@create']);
        Route::get('destroy', ['as'=>'nacionalidades.destroy', 'uses'=>'NacionalidadesController@destroy']);
        Route::get('edit', ['as'=>'nacionalidades.edit', 'uses'=>'NacionalidadesController@edit']);
        Route::put('{id}/update', ['as'=>'nacionalidades.update', 'uses'=>'NacionalidadesController@update']);
        Route::post('store', ['as'=>'nacionalidades.store', 'uses'=>'NacionalidadesController@store']);
    
    });

    Route::group(['prefix'=>'filmes', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('', ['as'=>'filmes', 'uses'=>'FilmesController@index']);
        Route::get('create', ['as'=>'filmes.create', 'uses'=>'FilmesController@create']);
        Route::post('store', ['as'=>'filmes.store', 'uses'=>'FilmesController@store']);
    
    });
});