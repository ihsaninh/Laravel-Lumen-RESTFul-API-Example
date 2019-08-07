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


# Question Routes
$router->get('/questions', 'QuestionController@index');
$router->get('/question', 'QuestionController@show');

# Answer Routes
$router->get('/answers', 'AnswerController@index');
$router->post('/answers', 'AnswerController@store');