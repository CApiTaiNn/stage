<?php

    require __DIR__ . '/../models/UserModel.php';

    class UserController{
        private $userModel;

        public function __construct(){
            $this->userModel = new UserModel();
        }

        public function getUsers(){
            return $this->userModel->getUsers();
        }
    }
?>