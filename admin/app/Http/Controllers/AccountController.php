<?php

    namespace App\Http\Controllers;

    class AccountController extends Controller{
        
        /*
        * @return route('login') et supprime la session
        */
        public function logout(){
            session()->pull('name');
            return view('login');
        }
    }
?>