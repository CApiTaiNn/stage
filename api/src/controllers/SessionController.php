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

        function valideAuth($id_session, $auth_id, $auth_pass){
            return $this->sessionModel->valideAuth($id_session, $auth_id, $auth_pass);
        }

        function suppSession($id_session){
            return $this->sessionModel->suppSession($id_session);
        }
    }