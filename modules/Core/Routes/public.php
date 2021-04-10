<?php

use Illuminate\Routing\Router;
use Modules\Core\Http\Controllers\Public\HomeController;

/**
 * @var Router $router
 */

$router->group(['prefix' => ''], function (Router $router) {
    // Home
    $router->get('', [HomeController::class, 'index'])->name('home');
});
