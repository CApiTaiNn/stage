<?php
//             //Création de la session
use Controllers\SessionController;
use Controllers\UserController;

    return static function ($app) {
        $app->post('/login', 'Controller\UserModel:login');
        $app->post('/authentification', 'Controller\UserModel:login');
        $app->post('/errorAuth', 'Controller\UserModel:login');
    };


?>