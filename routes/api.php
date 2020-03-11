<?php

Route::prefix('pizzas')->group(function(){
    Route::post('create', 'PizzasController@create');
    Route::put('update/{pizza}', 'PizzasController@update');
    Route::delete('delete/{pizza}', 'PizzasController@delete');
});

Route::post('customers/create', 'CustomersController@create');
Route::prefix('orders')->group(function(){
    Route::post('create', 'OrdersController@create');
    Route::patch('update-status/{order}', 'OrdersController@updateStatus');
    Route::delete('delete/{order}', 'OrdersController@deleteOrder');
    Route::get('filter', 'OrdersController@getOrder');
    Route::get('list', 'OrdersController@listOrders');
});
