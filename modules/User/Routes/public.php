<?php

use Illuminate\Routing\Router;
use Modules\User\Http\Controllers\Web\AuthController;

/**
 * @var Router $router
 */

$router->group(['prefix' => 'auth'], function (Router $router) {
    // Login
    $router->get('login', [AuthController::class, 'getLogin'])->name('auth.login');
    $router->post('login', [AuthController::class, 'postLogin'])->name('auth.login');
    // Register
    $router->get('register', [AuthController::class, 'getRegister'])->name('auth.register');
    $router->post('register', [AuthController::class, 'postRegister'])->name('auth.register');
    // Forgot password
    $router->post('forgot', [AuthController::class, 'postForgotPassword'])->name('auth.forgot_password');
    // Logout
    $router->get('logout', [AuthController::class, 'getLogout'])->name('auth.logout');
});
