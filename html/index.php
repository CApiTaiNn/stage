<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/controllers/UserController.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$userController = new UserController();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("hello");
    return $response;
});


$app->get('/users', function ($request, $response) {
    $users = $userController->getUsers();
    $response->getBody()->write($json_encode($users));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
