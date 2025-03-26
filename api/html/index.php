<?php

    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../src/controllers/UserController.php';
    require __DIR__ . '/../src/config/Database.php';

    use Slim\Factory\AppFactory;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app = AppFactory::create();

    //Controller et DB
    $db = new Database();
    $userController = new UserController();


    //REQUESTS GET
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("hello");
        return $response;
    });


    //REQUESTS POST
    $app->post('/login', function (Request $request, Response $response) use ($db, $userController) {
        $data = json_decode($request->getBody()->getContents(), true);
        $config = $db->getDatabaseConfig($data['base']);
        $db->setDB($data['base'], $config['username'], $config['password']);
        $userController->setDB($db);
        if ($userController->createUser($data)) {
            return $response->withStatus(201)->withHeader('Access-Control-Allow-Origin', '*');
        } else {
            return $response->withStatus(400);
        }
    });



    //REQUESTS OPTIONS
    $app->options('/{routes:.+}', function (Request $request, Response $response) {
        return $response->withHeader('Access-Control-Allow-Origin', '*')
                        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                        ->withHeader('Access-Control-Allow-Credentials', 'true')
                        ->withStatus(200);
    });


    $app->run();

?>