<?php

    require __DIR__ . '/../models/UserModel.php';

    class UserController{
        private $userModel;

        public function __construct(){
            $this->userModel = new UserModel($db);
        }

        public function getUsers(){
            return $this->userModel->getUsers();
        }

        public function createUser($user){
            return $this->userModel->createUser($user);
        }
    }
?>