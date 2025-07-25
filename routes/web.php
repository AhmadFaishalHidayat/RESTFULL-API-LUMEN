<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'categories'], function () use ($router) {
        $router->get('/', 'CategoryController@index');
        $router->get('/{id}', 'CategoryController@show');
        $router->get('/{id}/posts', 'CategoryController@showPostsByCategory');

        $router->post('/', 'CategoryController@store');
        $router->put('/{id}', 'CategoryController@update');
        $router->delete('/{id}', 'CategoryController@destroy');
    });
    $router->group(['prefix' => 'posts', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'PostController@index');
        $router->get('/filter', 'PostController@getFiltered');
        $router->get('/{id}', 'PostController@show');
        $router->post('/', 'PostController@store');
        $router->put('/{id}', 'PostController@update');
        $router->delete('/{id}', 'PostController@destroy');
    });

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('/register', 'AuthController@register');
        $router->post('/login', 'AuthController@login');
        // $router->post('/logout', 'AuthController@logout');
    });
});

$router->get('/admin-only', ['middleware' => 'role:editor', function () {
    return 'This route only accessible by editor.';
}]);

$router->post('/post/create', ['middleware' => 'permission:create-post', 'uses' => 'PostController@store']);
