<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', function () {
        return view('products');
    });

    Route::resource('products', 'ProductsController');



/*
Route::group(['middleware' => ['api']], function () {
    Route::post('/products', 'ProductsController@create');
    Route::patch('/products/{id}', 'ProductsController@update');
    Route::delete('/products/{id}', 'ProductsController@delete');
    Route::get('/products', 'ProductsController@all');
});

*/
