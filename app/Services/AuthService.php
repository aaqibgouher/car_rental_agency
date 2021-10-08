<?php

namespace App\Services;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\Rule;
use App\Utilities\Common;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

interface AuthInterface
{
    public static function register($user_type, $first_name, $last_name, $email, $password);
    public static function login($email, $password);
    public static function encrypt_password($password);
    public static function check_password($password, $user_password);
    public static function logout($user_id);
}

class AuthService implements AuthInterface
{
    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @return integer user id of created user
     */
    public static function register($user_type, $first_name, $last_name, $email, $password)
    {
        $user_id = UserService::add($user_type, $first_name, $last_name, $email, $password);
        $user = AuthService::login($email, $password);
        return $user;
    }

    public static function login($email, $password)
    {
        $validator = Validator::make(compact("email", "password"), [
            "email" => Rule::get("email", true),
            "password" => Rule::get("password", true)
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $user = UserService::get_by_email($email);
        if (!$user) throw new Exception("Invalid Email");
        if (!AuthService::check_password($password, $user->password)) throw new Exception("Invalid email and password");

        $user_id = $user->id;
        $token = UserTokenService::generate_jwt_token($user_id);
        UserTokenService::delete_expired_tokens($user_id);
        UserTokenService::insert_token_by_user_id($user_id, $token);
        UserService::edit($user_id, ["login_at" => Common::now()]);

        $data = [
            "id" => $user_id,
            "user_type" => $user->user_type,
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "full_name" => $user->first_name.' '.$user->last_name,
            "avatar" => $user->first_name[0]."".$user->last_name[0],
            "token" => $token
        ];
        return $data;
    }

    public static function logout($user_id)
    {
        $token = Auth::token();
        UserTokenService::delete_token_by_user_id($user_id, $token);
        session()->flush();
    }

    public static function encrypt_password($password){
        return bcrypt($password);
    }

    public static function check_password($password, $user_password){
        return Hash::check($password, $user_password) ? true : false;
    }
}
