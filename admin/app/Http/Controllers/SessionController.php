<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Session;


class SessionController extends Controller{
    private $sessionModel;

    public function __construct(){
        $this->sessionModel = new Session();
    }
    
    public function getCurrentSession(){
        $response = $this->sessionModel->getCurrentSession();
        if($response['status'] === 'success'){
            return $response['data']['currentSession'];
        }else{
            return false;
        }
    }

    public function getDaySession(){
        $response = $this->sessionModel->getDaySession();
        if($response['status'] === 'success'){
            return $response['data']['daySession'];
        }else{
            return false;
        }
    }

    public function get10LastSession(){
        $response = $this->sessionModel->get10LastSession();
        if($response['status'] === 'success'){
            return $response['data'];
        }else{
            return false;
        }
    }
}
