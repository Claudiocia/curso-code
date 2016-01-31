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
    return view('index');
});


Route::group(['prefix'=> 'admin', 'middleware'=> 'auth.checkrole:admin'], function(){

    Route::get('categorias', ['as'=>'index.categoria', 'uses'=>'CategoriesController@index']);
    Route::get('categorias/nova', ['as'=>'nova.categoria', 'uses'=>'CategoriesController@create']);
    Route::get('categorias/editar/{id}', ['as'=>'edita.categoria', 'uses'=>'CategoriesController@edit']);
    Route::post('categorias/update/{id}', ['as'=>'altera.categoria', 'uses'=>'CategoriesController@update']);
    Route::post('categorias/salvar', ['as'=>'salva.categoria', 'uses'=>'CategoriesController@store']);

    Route::get('clientes', ['as'=>'index.cliente', 'uses'=>'ClientsController@index']);
    Route::get('clientes/nova', ['as'=>'nova.cliente', 'uses'=>'ClientsController@create']);
    Route::get('clientes/editar/{id}', ['as'=>'edita.cliente', 'uses'=>'ClientsController@edit']);
    Route::post('clientes/update/{id}', ['as'=>'altera.cliente', 'uses'=>'ClientsController@update']);
    Route::post('clientes/salvar', ['as'=>'salva.cliente', 'uses'=>'ClientsController@store']);

    Route::get('produtos', ['as'=>'index.produto', 'uses'=>'ProductsController@index']);
    Route::get('produtos/nova', ['as'=>'nova.produto', 'uses'=>'ProductsController@create']);
    Route::get('produtos/editar/{id}', ['as'=>'edita.produto', 'uses'=>'ProductsController@edit']);
    Route::post('produtos/update/{id}', ['as'=>'altera.produto', 'uses'=>'ProductsController@update']);
    Route::post('produtos/salvar', ['as'=>'salva.produto', 'uses'=>'ProductsController@store']);
    Route::get('produtos/deletar/{id}', ['as'=>'deleta.produto', 'uses'=>'ProductsController@destroy']);

    Route::get('ordens', ['as'=>'index.ordem', 'uses'=>'OrdersController@index']);
    Route::get('ordens/editar/{id}', ['as'=>'edita.ordem', 'uses'=>'OrdersController@edit']);
    Route::post('ordens/update/{id}', ['as'=>'altera.ordem', 'uses'=>'OrdersController@update']);

    Route::get('cupoms', ['as'=>'index.cupom', 'uses'=>'CupomsController@index']);
    Route::get('cupoms/nova', ['as'=>'nova.cupom', 'uses'=>'CupomsController@create']);
    Route::get('cupoms/editar/{id}', ['as'=>'edita.cupom', 'uses'=>'CupomsController@edit']);
    Route::post('cupoms/update/{id}', ['as'=>'altera.cupom', 'uses'=>'CupomsController@update']);
    Route::post('cupoms/create', ['as'=>'salva.cupom', 'uses'=>'CupomsController@store']);
});

Route::group(['prefix'=>'customer'], function(){

    Route::get('ordem/nova', ['as'=>'nova.ordem', 'uses'=>'CheckoutController@create']);
    Route::post('ordem/store', ['as'=>'salvar.ordem', 'uses'=>'CheckoutController@store']);
    Route::get('ordem', ['as'=>'index.ordem', 'uses'=>'CheckoutController@index']);
    Route::get('welcome', ['as'=>'welcome', 'uses'=>'CheckoutController@inicio']);

});

Route::group(['middleware' => 'cors'], function(){

    Route::post('oauth/access_token', function() {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function(){

        Route::group(['prefix' => 'client', 'middleware' => 'oauth.checkrole:client', 'as' => 'client.'], function(){

            Route::resource('order',
                'Api\Client\ClientCheckoutController',
                ['except' => ['create', 'edit', 'destroy']
                ]);
            Route::get('products', 'Api\Client\ClientProductController@index');
        });

        Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'], function(){

            Route::resource('order',
                'Api\Deliveryman\DeliveryCheckoutController',[
                    'except' => ['create', 'edit', 'destroy', 'store']
                ]);
            Route::patch('order/{id}/update-status',[
                'uses'=> 'Api\Deliveryman\DeliveryCheckoutController@updateStatus',
                'as'=> 'ordem.entregue'
            ] );
        });


    });
});
