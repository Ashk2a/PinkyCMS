<?php

use Illuminate\Routing\Router;
use Modules\User\Http\Controllers\Web\AuthController;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'auth'], function (Router $router) {
    // Login
    $router->get('login', [AuthController::class, 'getLogin'])->name('auth.login');
    $router->post('login', [AuthController::class, 'login'])->name('auth.login');
    // Register
    $router->get('register', [AuthController::class, 'getRegister'])->name('auth.register');
    $router->post('register', [AuthController::class, 'register'])->name('auth.register');
    // Forgot password
    $router->post('forgot', [AuthController::class, 'forgotPassword']);
});
