<?php

namespace App\Services;

use App\Models\Enums\IsDeletedEnum;
use Exception;
use Validator;
use App\Utilities\Rule;
use App\Models\UserModel;
use App\Utilities\Common;
use App\Services\AuthService;

interface UserInterface
{
    public static function add($user_type, $first_name, $last_name, $email, $password);
    public static function get_by_email($email);
    public static function get_by_id($id);

}

class UserService implements UserInterface
{
    public static function add($user_type, $first_name, $last_name, $email, $password)
    {
        $validator = Validator::make(compact("user_type", "first_name", "last_name", "email", "password"), [
            "user_type" => Rule::get("user_type", true),
            "first_name" => Rule::get('name', true),
            "last_name" => Rule::get('name', true),
            "email"     => Rule::get('email', true),
            "password"  => Rule::get('password', true),
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $user = UserService::get_by_email($email);
        
        if($user) throw new Exception("Email already exists");

        $user_id = UserModel::insertGetId([
            "user_type" => $user_type,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "password" => AuthService::encrypt_password($password),
            'created_at' => Common::now(),
            'updated_at' => Common::now(),
        ]);
        
        return $user_id;
    }

    public static function edit($id, $params)
    {
        $validator = Validator::make($params, [
            "user_type" => Rule::get("user_type"),
            "first_name" => Rule::get('name'),
            "last_name" => Rule::get('name'),
            "email"     => Rule::get('email'),
            "password"  => Rule::get('password'),
            "login_at" => Rule::get('datetime')
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        // user_params
        $user_params = [];
        if ($params && array_key_exists("user_type", $params)) $user_params["user_type"] = $params["user_type"];
        if ($params && array_key_exists("first_name", $params)) $user_params["first_name"] = $params["first_name"];
        if ($params && array_key_exists("last_name", $params)) $user_params["last_name"] = $params["last_name"];
        if ($params && array_key_exists("email", $params)) $user_params["email"] = $params["email"];
        if ($params && array_key_exists("password", $params)) $user_params["password"] = $params["password"];
        if ($params && array_key_exists("login_at", $params)) $user_params["login_at"] = $params["login_at"];
        $user_params['updated_at'] = Common::now();

        UserModel::where('id', $id)->update($user_params);
    }

    public static function get_by_email($email) {
        return UserModel::where('email', $email)->where('is_deleted', IsDeletedEnum::not_deleted)->first();
    }    
    
    public static function get_by_id($id)
    {
        return UserModel::where('id', $id)->where('is_deleted', IsDeletedEnum::not_deleted)->first();
    }
}
