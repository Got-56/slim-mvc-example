<?php

use DI\Container;
use Slim\Factory\AppFactory;
use App\Controllers\UserController;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/users', [UserController::class, 'index']);
$app->get('/users/{id}', [UserController::class, 'show']);
$app->post('/users', [UserController::class, 'create']);
$app->put('/users/{id}', [UserController::class, 'update']);

return $app;

