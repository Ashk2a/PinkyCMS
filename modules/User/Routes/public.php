<?php

use Illuminate\Routing\Router;
use Modules\User\Http\Controllers\Web\LoginController;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'auth'], function (Router $router) {
    $router->get('login', [LoginController::class, 'index']);
});
