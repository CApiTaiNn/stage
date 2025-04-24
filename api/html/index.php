<?php

    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../src/Controllers/UserController.php';
    require __DIR__ . '/../src/Controllers/SessionController.php';
    require __DIR__ . '/../src/Controllers/BossController.php';
    require __DIR__ . '/../src/Utils/CheckApiKeyMiddleware.php';
    require __DIR__ . '/../src/Config/Database.php';
    require __DIR__ . '/../src/Utils/sendMail.php';
    require __DIR__ . '/../src/Utils/generator.php';

    use Slim\Factory\AppFactory;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app = AppFactory::create();

    $app->add(CheckApiKeyMiddleware::class);

    //Création de DB sans configuration
    $db = new Database();

    //Création des controllers
    $userController = new UserController();
    $sessionController = new SessionController();
    $bossController = new BossController();

    //REQUESTS GET
    $app->get('/', function (Request $request, Response $response) use ($userController) {
        $response->getBody()->write($userController->getIp());
        return $response;
    });


    $app->get('/users', function (Request $request, Response $response) use ($db, $userController) {
        $name = $request->getQueryParams()['name'] ?? null;
        //Configuration de la base de données
        $orga = $request->getHeaderLine('ORGANIZATION');
        $db->setDB($orga, getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
        $userController->setDB($db);

        //Récupération de tous les utilisateurs
        if($userTab = $userController->getAllUsers($name)){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $userTab]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error', 'data' => $userTab]));
            return $response->withStatus(400);
        }
    });

    $app->get('/currentsession', function (Request $request, Response $response) use ($db, $sessionController) {
        //Configuration de la base de données
        $orga = $request->getHeaderLine('ORGANIZATION');
        $db->setDB($orga, getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
        $sessionController->setDB($db);

        //Récupération de la session courante
        if($currentSession = $sessionController->getCurrentSession()){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $currentSession]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(400);
        }
    });

    $app->get('/daysession', function (Request $request, Response $response) use ($db, $sessionController) {
        //Configuration de la base de données
        $orga = $request->getHeaderLine('ORGANIZATION');
        $db->setDB($orga, getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
        $sessionController->setDB($db);

        //Récupération de la session courante
        if($daySession = $sessionController->getDaySession()){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $daySession]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(400);
        }
    });

    $app->get('/10lastsession', function (Request $request, Response $response) use ($db, $sessionController) {
        //Configuration de la base de données
        $orga = $request->getHeaderLine('ORGANIZATION');
        $db->setDB($orga, getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
        $sessionController->setDB($db);

        //Récupération de la session courante
        if($lastSession = $sessionController->get10LastSession()){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $lastSession]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(400);
        }
    });

    $app->get('/userError', function (Request $request, Response $response) use ($db, $userController) {
        //Configuration de la base de données
        $orga = $request->getHeaderLine('ORGANIZATION');
        $db->setDB($orga, getenv('USERNAMEBOSS'), getenv('PASSWORDBOSS'));
        $userController->setDB($db);

        //Récupération de tous les utilisateurs
        if($userTab = $userController->getUserError()){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $userTab]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(400);
        }
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

        $hashId = password_hash($code[0], PASSWORD_DEFAULT);
        $hashCode = password_hash($code[1], PASSWORD_DEFAULT);
        $idSession = random_int(0, 9999999999);

        //Vérification de l'existence de l'utilisateur
        //Si l'utilisateur n'existe pas, on le crée
        if (!$userController->ifExist($data['name'], $data['firstname'], $data['email'])) {
            $userController->createUser($data);
        }

        //On recupère l'id de l'utilisateur
        $id_user = $userController->getUserId($data['name'], $data['firstname'], $data['email']);
        //Puis on creer la session pour l'utilisateur
        if ($sessionController->createSession($idSession, $id_user, $hashId, $hashCode)) {

            //Id de session dans un cookie sécurisé
            setcookie("SESSION_ID", $idSession, [
                'expires' => time() + 3600,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);

            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(201);
        }else {
            error_log("Erreur lors de la création de la session");
            $response->getBody()->write(json_encode(['status' => 'error']));
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
        if ($sessionController->valideAuth( $data['id_session'], $data['id'], $data['code'])) {
            // Réponse en cas de succès
            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(201); 
        } else {
            // Réponse en cas d'échec
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(401); 
        }
    });



    
    //REQUESTS PUT
    $app->put('/invalideSession', function (Request $request, Response $response) use ($db, $sessionController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);

        //Recupération de la base de données
        $config = $db->getDatabaseConfig($data['orga']);
        //Connexion à la base de données
        $db->setDB($data['orga'], $config['username'], $config['password']);
        $sessionController->setDB($db);

        //Suppression de la session créer pour l'utilisateur
        if ($sessionController->invalideSession($data['id_session'])) {
            // Réponse en cas de succès
            $response->getBody()->write(json_encode(['status' => 'success', 'message' => 'Session invalide']));
            return $response->withStatus(200);
        } else {
            // Réponse en cas d'échec
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Erreur lors de l`invalidation de la session']));
            return $response->withStatus(400);
        }
    });



    //REQUESTS BOSS
    $app->post('/loginboss', function (Request $request, Response $response) use ($bossController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);

        //Authentification du Boss
        if($bossController->login($data['name'], $data['password'])){
            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(401);
        }   
    });

    $app->post('/a2fIsActivated', function (Request $request, Response $response) use ($bossController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);

        //Verifie si l'authentification à deux facteurs est activée
        if($bossController->a2fIsActivated($data['name'])){
            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(401);
        }   
    });

    $app->post('/setbosssecret', function (Request $request, Response $response) use ($bossController) {
        //Récupération des données
        $data = json_decode($request->getBody()->getContents(), true);
        
        //Enregistre le secret dans la base de données
        if($bossController->setSecret($data['name'], $data['secret'])){
            $response->getBody()->write(json_encode(['status' => 'success']));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(401);
        }   
    });

    $app->get('/getbosssecret', function (Request $request, Response $response) use ($bossController) {
        //Récupération des données
        $name = $request->getQueryParams()['name'];
        //Recupere le secret dans la base de données
        if($secret = $bossController->getSecret($name)){
            $response->getBody()->write(json_encode(['status' => 'success', 'data' => $secret]));
            return $response->withStatus(200);
        }else{
            $response->getBody()->write(json_encode(['status' => 'error']));
            return $response->withStatus(401);
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