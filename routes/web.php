<?php



Auth::routes();

Route::get('/admin','HomeController@index');
Route::get('/admin/{any}','HomeController@index')->where('any', '.*');

Route::get('/{any}', function(){
    return view('web');
})->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
