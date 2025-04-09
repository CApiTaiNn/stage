<?php

    require __DIR__ . '/../Models/UserModel.php';

    class UserController{
        private $userModel;

        function __construct(){
            $this->userModel = new UserModel();
        }

        public function setDB($db){
            $this->userModel->setDB($db->getConnection());
        }

        public function getAllUsers(){
            return $this->userModel->getAllUsers();
        }

        public function createUser($user){
            return $this->userModel->createUser($user);
        }

        public function getIp(){
            return $this->userModel->getIp();
        }

        public function getUserId($name, $firstname, $email){
            return $this->userModel->getUserId($name, $firstname, $email);
        }

        public function ifExist($name, $firstname, $email){
            return $this->userModel->ifExist($name, $firstname, $email);
        }
    }
?>