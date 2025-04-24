<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Boss extends Model{
    private $name;
    private $password;
    private $establishment;
    private $a2f_activated;
    private $a2f_secret;


    function getAllBoss(){
        return Http::get(config('url.AllBoss'), [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'address' => $this->address,
            'company' => $this->company
        ]);
    }

    function a2fIsActivated($name){
        return Http::withHeaders([
            "X-API-KEY" => getenv('API_KEY')
        ])->post(config('url.A2FIsActivated'), [
            'name' => $name
        ]);
    }

    function login($name, $passwordHash){
        return Http::withHeaders([
            "X-API-KEY" => getenv('API_KEY')
        ])->post(config('url.BossLogin'), [
            'name' => $name,
            'password' => $passwordHash
        ]);
    }

    function setSecret($name, $secret){
        return Http::withHeaders([
            "X-API-KEY" => getenv('API_KEY')
        ])->post(config('url.SetBossSecret'), [
            'name' => $name,
            'secret' => $secret
        ]);
    }

    function getSecret($name){
        return Http::withHeaders([
            "X-API-KEY" => getenv('API_KEY')
        ])->get(config('url.GetBossSecret'), [
            'name' => $name
        ]);
    }
}
