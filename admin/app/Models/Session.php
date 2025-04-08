<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model{
    private $sessionId;
    private $userId;
    private $date;
    private $auth_id;
    private $auth_pass;

    function __construct($sessionId, $userId, $date, $auth_id, $auth_pass){
        $this->sessionId = $sessionId;
        $this->userId = $userId;
        $this->date = $date;
        $this->auth_id = $auth_id;
        $this->auth_pass = $auth_pass;
    }

    function getAllSession(){
        return Http::get(config('url.AllSession'), [
            'sessionId' => $this->sessionId,
            'userId' => $this->userId,
            'date' => $this->date,
            'auth_id' => $this->auth_id,
            'auth_pass' => $this->auth_pass
        ]);
    }

}
