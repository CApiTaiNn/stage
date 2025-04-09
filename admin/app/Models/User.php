<?php

    namespace App\Models;

    use Illuminate\Support\Facades\Http;

    class User{
        private $id_user;
        private $name;
        private $firstname;
        private $email;
        private $phone;

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
        
        

        function getAllUsers() {
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name'),
            ])->get(config('url.AllUser'));
        }
    }