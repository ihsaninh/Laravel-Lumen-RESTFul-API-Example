<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

# User Routes
$router->get('/users', 'UserController@index');
$router->get('/users/{user}', 'UserController@show');
$router->post('/users', 'UserController@store');
$router->put('/users/{user}', 'UserController@update');
$router->delete('/users/{user}', 'UserController@destroy');


# Auth Routes
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');