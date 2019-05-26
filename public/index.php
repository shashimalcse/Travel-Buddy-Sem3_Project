<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

Twig_Autoloader::register();


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

session_start();


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login',['controller' => 'Login', 'action' => 'new']);
$router->add('logout',['controller' => 'Login ', 'action' => 'destroy']);
$router->add('password/reset/{token:[\da-f]+}',['controller'=>'Password','action' => 'reset']);
$router->add('signup/activate/{token:[\da-f]+}',['controller'=>'Signup','action' => 'activate']);

$router->add('imformation/vehical-edit/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'vehical-edit']);
$router->add('imformation/vehical-del/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'vehical-del']);
$router->add('imformation/change-vehical/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'change-vehical']);

$router->add('imformation/hotel-edit/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'hotel-edit']);
$router->add('imformation/hotel-del/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'hotel-del']);
$router->add('imformation/change-hotel/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'change-hotel']);

$router->add('imformation/shop-edit/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'shop-edit']);
$router->add('imformation/shop-del/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'shop-del']);
$router->add('imformation/change-shop/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'change-shop']);

$router->add('imformation/guider-edit/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'guider-edit']);
$router->add('imformation/guider-del/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'guider-del']);
$router->add('imformation/change-guider/{id:[\da-f]+}',['controller'=>'Imformation','action' => 'change-guider']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
