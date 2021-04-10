<?php

use Illuminate\Routing\Router;
use Modules\User\Http\Controllers\Public\AuthController;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'auth', 'middleware' => ['user.guest']], function (Router $router) {
    // Login
    $router->get('login', [AuthController::class, 'getLogin'])->name('login');
    $router->post('login', [AuthController::class, 'postLogin'])->name('login.get');
    // Register
    $router->get('register', [AuthController::class, 'getRegister'])->name('register');
    $router->post('register', [AuthController::class, 'postRegister'])->name('register.post');

});

$router->group(['prefix' => 'auth', 'middleware' => ['user.auth']], function (Router $router) {
    // Logout
    $router->get('logout', [AuthController::class, 'getLogout'])->name('logout');
});
