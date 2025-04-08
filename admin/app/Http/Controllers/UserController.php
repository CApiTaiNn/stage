<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller{
    private $userModel;
    
    public function getAllBoss(){
        return $this->userModel->getAllBoss();
    }
    
}
