<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

# User Routes
$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@store');
$router->get('/users/{user}', 'UserController@show');
$router->put('/users/{user}', 'UserController@update');
$router->delete('/users/{user}', 'UserController@destroy');

# Feed Routes
$router->get('/feeds', 'FeedController@index');
$router->post('/feeds', 'FeedController@store');
$router->get('/feeds/{feed}', 'FeedController@show');
$router->put('/feeds/{feed}', 'FeedController@update');
$router->delete('/feeds/{feed}', 'FeedController@destroy');

# Auth Routes
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');