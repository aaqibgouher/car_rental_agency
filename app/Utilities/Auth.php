<?php

namespace App\Utilities;

use App\Services\UserService;

class Auth{
    public static function id(){
        return session()->get('user_id');
    }

    public static function token(){
        return session()->get('token');
    }

    public static function user(){
        $user_id = Auth::id();
        $user = UserService::get_by_id($user_id);
        return $user;
    }
}