<?php

$app->get('/', function() use ($app) {
    return view('index'); //$app->welcome();
});

$app->post('/create-user', 'App\Http\Controllers\UserController@store');

$app->get('/read-users', 'App\Http\Controllers\UserController@index');

$app->get('/read-user/{id}', 'App\Http\Controllers\UserController@show');

$app->post('/edit-user/{id}', 'App\Http\Controllers\UserController@update');

$app->post('/delete-user', 'App\Http\Controllers\UserController@destroy');