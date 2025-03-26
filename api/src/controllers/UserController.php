<?php

    require __DIR__ . '/../models/UserModel.php';

    class UserController{
        private $userModel;

        public function __construct(){
            $this->userModel = new UserModel();
        }

        public function setDB($db){
            $this->userModel->setDB($db->getConnection());
        }

        public function getUsers(){
            return $this->userModel->getUsers();
        }

        public function createUser($user){
            return $this->userModel->createUser($user);
        }
    }
?>