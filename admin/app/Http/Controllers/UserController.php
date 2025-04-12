<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller{
    private $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function setId($val){
        $this->userModel->setId($val);
    }
    public function setName($val){
        $this->userModel->setName($val);
    }
    public function setFirstname($val){
        $this->userModel->setFirstname($val);
    }
    public function setEmail($val){
        $this->userModel->setEmail($val);
    }
    public function setPhone($val){
        $this->userModel->setPhone($val);
    }
    public function setNbCo($val){
        $this->userModel->setNbCo($val);
    }
    public function setLastCo($val){
        $this->userModel->setLastCo($val);
    }
    public function setStatus($val){
        $this->userModel->setStatus($val);
    }

    
    public function getAllUsers(){
        $response = $this->userModel->getAllUsers();
        $users = [];
        dd($response->json());

        if($response['status'] === 'success'){
            foreach($response['data'] as $user){
                $u = new User();
                $u->setId($user['id_user']);
                $u->setName($user['name']);
                $u->setFirstname($user['firstname']);
                $u->setEmail($user['email']);
                $u->setPhone($user['phone']);
                $u->setNbCo($user['nbCo']);
                $u->setLastCo($user['lastCo']);
                $u->setStatus($user['status']);
                $users[] = $u;
            }
            return view('listUser', ['users' => $users]);
        }else{
            return false;
        }
    }
}
