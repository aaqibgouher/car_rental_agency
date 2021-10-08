<?php

namespace App\Models\Enums;

class UserTypeEnum
{
    public const agency = 1;
    public const customer = 0;

    // public static function get($key = ""){
    //     $data = [
    //         static::admin => ["label" => "Admin", "color" => "primary--text"],
    //         static::user => ["label" => "User", "color" => "primary--text"],
    //     ];
    //     return static::get_wrapper($data, $key);
    // }

    // public static function select(){
    //     return static::select_wrapper(static::get());
    // }

}