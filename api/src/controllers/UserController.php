<?php

    require __DIR__ . '/../models/UserModel.php';

    class UserController{
        private $userModel;

        public function __construct(){
            $this->userModel = new UserModel();
        }

        function getUsers(){
            $Users = $this->userModel->getUsers();
            return $Users;
        }
    }
?>