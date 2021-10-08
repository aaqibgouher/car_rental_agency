<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Utilities\JWTLibrary;
use App\Models\UserTokenModel;
use App\Utilities\ApiOutput;

class UserAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        try{
            $token = trim($request->input('token'));

            if(!$token) throw new Exception("Please Login To Continue");
            
            $jwt = JWTLibrary::decode($token);
            
            $user_id = $jwt->user_id;

            $user_token = UserTokenModel::where('token', $token)->where('user_id', $user_id)->first();

            if(!$user_token) throw new Exception("Token Doesn't Matched");
            
            session()->put('user_id', $user_id);
            session()->put('token', $token);

            return $next($request);

        }catch(Exception $e){
            return ApiOutput::error($e->getMessage());
        }
    }
}
