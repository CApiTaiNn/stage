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

        $response = $this->bossModel->login($name, $password);

        if ($response->status() == 200) {
            session(['name' => $name]);
            return redirect()->route('home');
        }else{
            return back()->withErrors([
                'name' => 'Identifiant ou mot de passe incorrect',
            ]);
        }
    }
}
