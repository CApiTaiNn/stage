<?php
    require __DIR__ . '/../models/SessionModel.php';

    class SessionController{
        private $sessionModel;


        function __construct(){
            $this->sessionModel = new SessionModel();
        }

        public function setDB($db){
            $this->sessionModel->setDB($db->getConnection());
        }


        function getSessions(){
            return $this->sessionModel->getSessions();
        }

        function createSession($id_user, $auth_id, $auth_pass){
            return $this->sessionModel->createSession($id_user, $auth_id, $auth_pass);
        }

        function valideAuth($email, $auth_id, $auth_pass){
            return $this->sessionModel->valideAuth($email, $auth_id, $auth_pass);
        }
    }