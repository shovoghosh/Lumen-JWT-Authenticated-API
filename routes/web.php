<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    // Matches "/api/register
   $router->post('register', 'AuthController@register');
   
     // Matches "/api/login
    $router->post('login', 'AuthController@login');

    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/api/user 
    //get one user by id
    $router->get('user/{id}', 'UserController@singleUser');

    // Matches "/api/users
    $router->get('users', 'UserController@allUsers');

    //update user "/api/user
    //update one user by id

    $router ->put('user/{id}','AuthController@updateUser');

    //delete user "/api/user
    //delete one user by id

    $router ->delete('user/{id}','UserController@deleteUser');



});
