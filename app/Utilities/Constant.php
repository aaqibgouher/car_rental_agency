<?php
namespace App\Utilities;

class Constant {
    public static function get($key){
        return config("constant.$key");
    }
}