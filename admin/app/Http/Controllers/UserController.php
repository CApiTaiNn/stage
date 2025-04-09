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
    
    public function getAllUsers(){
        $response = $this->userModel->getAllUsers();
        $users = [];

        if($response['status'] === 'success'){
            foreach($response['data'] as $user){
                $u = new User();
                $u->setId($user['id_user']);
                $u->setName($user['name']);
                $u->setFirstname($user['firstname']);
                $u->setEmail($user['email']);
                $u->setPhone($user['phone']);
                $users[] = $u;
            }
            return view('listUser', ['users' => $users]);
        }else{
            return false;
        }
    }
}
