<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model{
    private $name;
    private $password;
    private $email;
    private $phone;
    private $address;
    private $company;

    public function __construct($name, $password, $email, $phone, $address, $company){
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->company = $company;
    }

    public function getName(){
        return Http::get(config('url.AllBoss'), [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'company' => $this->company
        ]);
    }
}
