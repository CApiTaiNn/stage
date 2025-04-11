<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\SessionController;

    class HomeController extends Controller{
        private $sessionController;

        public function __construct(){
            $this->sessionController = new SessionController();
        }
        
        /*
        * @return route('home') et 3 variables
        * Appel 3 fonction pour recuperer les infos a afficher dans home
        */
        public function index(){
            $currentSession = $this->sessionController->getCurrentSession();
            $daySession = $this->sessionController->getDaySession();
            $lastSession = $this->sessionController->get10LastSession();
            return view('home', compact('currentSession', 'daySession', 'lastSession'));
        }
    }
?>