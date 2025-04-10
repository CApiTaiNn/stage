<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Http;

    class Session extends Model{
        private $sessionId;
        private $userId;
        private $date;
        private $auth_id;
        private $auth_pass;


        public function getCurrentSession(){
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name')
            ])->get(config('url.CurrentSession'));
        }

        public function getDaySession(){
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name')
            ])->get(config('url.DaySession'));
        }

        public function get10LastSession(){
            return Http::withHeaders([
                "X-API-KEY" => getenv('API_KEY'),
                "ORGANIZATION" => session('name')
            ])->get(config('url.10LastSession'));
        }
    }
?>