<?php

namespace App\Services;

use Exception;
use App\Utilities\Common;
use Illuminate\Support\Str;
use App\Utilities\JWTLibrary;
use App\Models\UserTokenModel;
use Browser;

interface UserTokenInterface{
    public static function insert_token_by_user_id($user_id, $token);
    public static function generate_jwt_token($user_id);
    public static function delete_token_by_user_id($user_id, $token = '');
    public static function delete_expired_tokens($user_id);
}

class UserTokenService implements UserTokenInterface
{
    public static function insert_token_by_user_id($user_id, $token){

        UserTokenModel::insert([
            "user_id" => $user_id,
            "token" => $token,
            "created_at" => Common::now(),
            "updated_at" => Common::now()
        ]);
    }

    public static function generate_jwt_token($user_id){

        $is_exist = false;

        do {
            $new_token = JWTLibrary::encode($user_id);
            $is_exist = UserTokenModel::where('token', $new_token)->first();
        } while ($is_exist);

        return $new_token;
        
    }

    public static function delete_token_by_user_id($user_id, $token = ''){
        $db = UserTokenModel::where('user_id', $user_id);

        if($token){
            $db->where('token', $token);
        }

        $db->delete();
    }

    public static function delete_expired_tokens($user_id){
        $users = UserTokenModel::where('user_id', $user_id)->get();

        foreach($users as $user){
            try{
                JWTLibrary::decode($user->token);
                
            }catch(Exception $e){
                UserTokenModel::where('user_id', $user_id)->where('token', $user->token)->delete();
            }
        }
    }
}
