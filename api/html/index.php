<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/controllers/UserController.php';
require __DIR__ . '/../src/config/getDB.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

// Middleware pour gérer les en-têtes CORS
$app->add(function (Request $request, $handler) {
    $response = $handler->handle($request);
    $response = $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

    // Gérer les requêtes OPTIONS
    if ($request->getMethod() === 'OPTIONS') {
        return $response->withStatus(200);
    }
    return $response;
});


//REQUESTS GET

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("hello");
    return $response;
});


//REQUESTS POST
$app->post('/login', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $response->getBody()->write(json_encode(['message' => 'Login successful', 'data' => $data]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});


/*
    $data = $request->getParsedBody();
    $config = getDB($data['base']);

    $db = new Database($config['host'], $data['base'], $config['username'], $config['password']);
    $userController = new UserController($db);

    if ($userController->createUser($data)) {
        return $response->withStatus(201);
    } else {
        return $response->withStatus(400);
    }
*/


$app->run();