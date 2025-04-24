<?php
    require __DIR__ . '/../Models/BossModel.php';

    class BossController{
        private $bossModel;

        function __construct(){
            $this->bossModel = new BossModel();
        }

        public function setDB($db){
            $this->bossModel->setDB();
        }

        function getAllBoss(){
            return $this->bossModel->getAllBoss();
        }

        function login($name, $passwordHash){
            return $this->bossModel->login($name, $passwordHash);
        }

        function a2fIsActivated($name){
            return $this->bossModel->a2fIsActivated($name);
        }

        function setSecret($name, $secret){
            return $this->bossModel->setSecret($name, $secret);
        }

        function getSecret($name){
            return $this->bossModel->getSecret($name);
        }
    }
?>