<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Boss;


class BossController extends Controller{
    private $bossModel;

    public function __construct(){
        $this->bossModel = new Boss();
    }
    
    public function getAllBoss(){
        return $this->bossModel->getAllBoss();
    }


    /**
     * @param Request $request
     * 
     * Hash le mot de passe avant de l'envoyer à l'API
    */
    public function login(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');    

        if ($this->bossModel->login($name, $password)->status() == 200) {
            session(['name' => $name]);
            $response = $this->bossModel->a2fIsActivated($name);
            if($response->status() == 200){
                return redirect()->route('a2f');
            }else{
                dd($response->body());
                return redirect()->route('a2fActivation');
            }
        }else{
            return back()->withErrors([
                'name' => 'Identifiant ou mot de passe incorrect',
            ]);
        }
    }


    public function setSecret($name, $secret){
        $response = $this->bossModel->setSecret($name, $secret);
        if($response->status() == 200){
            return true;
        }else{
            false;
        }
    }

    public function getSecret($name){
        $response = $this->bossModel->getSecret($name);
        if($response->status() == 200){
            return $response->json()['data'][0]['a2f_secret'];
        }else{
            return false;
        }
    }
}
