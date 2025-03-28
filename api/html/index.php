<?php
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../src/controllers/UserController.php';
    require __DIR__ . '/../src/controllers/SessionController.php';
    require __DIR__ . '/../src/config/Database.php';
    require __DIR__ . '/../src/utils/sendMail.php';

    use Slim\Factory\AppFactory;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app = AppFactory::create();


    //Création de DB sans configuration
    $db = new Database();

    //Création des controllers
    $userController = new UserController();
    $sessionController = new SessionController();

    //REQUESTS GET
    $app->get('/', function (Request $request, Response $response) use ($userController) {
        $response->getBody()->write($userController->getIp());
        return $response;
    });


    //REQUESTS POST
    $app->post('/login', function (Request $request, Response $response) use ($db, $userController, $sessionController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);

        //Recupération de la base de données
        $config = $db->getDatabaseConfig($data['orga']);

        //Connexion à la base de données
        $db->setDB($data['orga'], $config['username'], $config['password']);
        $userController->setDB($db);
        $sessionController->setDB($db);

        //Envoie du mail avec les codes
        $code = sendMail($data['orga'], $data['email'], $data['name']);

        
        //Création de l'utilisateur
        if ($userController->createUser($data)) {
            $id_user = $userController->getUserId($data['name'], $data['firstname'], $data['email']);
            $sessionController->createSession($id_user, $code[0], $code[1]);
            return $response->withStatus(201)->withHeader('Access-Control-Allow-Origin', '*');
        } else {
            return $response->withStatus(400);
        }
    });



    $app->post('/authentification', function (Request $request, Response $response) use ($db, $sessionController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);

        //Recupération de la base de données
        $config = $db->getDatabaseConfig($data['orga']);

        //Connexion à la base de données
        $db->setDB($data['orga'], $config['username'], $config['password']);
        $sessionController->setDB($db);

        // Validation de l'authentification
        if ($sessionController->valideAuth($data['email'], $data['id'], $data['code'])) {
            // Réponse en cas de succès
            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(201); 
        } else {
            // Réponse en cas d'échec
            $response->getBody()->write(json_encode(["status" => "error", "message" => "Identifiants invalides"]));
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