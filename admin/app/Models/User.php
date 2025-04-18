<?php

    namespace App\Models;

    use Illuminate\Support\Facades\Http;

    class User{
        private $id_user;
        private $name;
        private $firstname;
        private $email;
        private $phone;
        private $nbCo;
        private $lastCo;
        private $status;
        private $nbError;

        function setId($val) {
            $this->id_user = $val;
        }
        function setName($val) {
            $this->name = $val;
        }
        function setFirstname($val) {
            $this->firstname = $val;
        }
        function setEmail($val) {
            $this->email = $val;
        }
        function setPhone($val) {
            $this->phone = $val;
        }
        function setNbCo($val) {
            $this->nbCo = $val;
        }
        function setLastCo($val) {
            $this->lastCo = $val;
        }
        function setStatus($val) {
            $this->status = $val;
        }
        function setNbError($val) {
            $this->nbError = $val;
        }


        
        function getNbCo() {
            return $this->nbCo;
        }
        function getLastCo() {
            return $this->lastCo;
        }
        function getStatus() {
            return $this->status;
        }
        function getId() {
            return $this->id_user;
        }
        function getName() {
            return $this->name;
        }
        function getFirstname() {
            return $this->firstname;
        }
        function getEmail() {
            return $this->email;
        }
        function getPhone() {
            return $this->phone;
        }
        function getNbError() {
            return $this->nbError;
        }
        
        function getAllUsers($name = null) {
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name'),
            ])->get(config('url.AllUser'),[
                'name' => $name
            ]);
        }


        function getUserError() {
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name'),
            ])->get(config('url.UserError'));
        }
    }