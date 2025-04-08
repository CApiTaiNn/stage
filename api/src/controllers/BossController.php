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
    }
?>