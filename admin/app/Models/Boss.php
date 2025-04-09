<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Boss extends Model{
    private $name;
    private $password;
    private $email;
    private $company;

    function __construct(){
        $this->name = "";
        $this->password = "";
        $this->email = "";
        $this->address = "";
        $this->company = "";
    }

    function getAllBoss(){
        return Http::get(config('url.AllBoss'), [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'address' => $this->address,
            'company' => $this->company
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
}
