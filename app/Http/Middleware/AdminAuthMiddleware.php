<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserTypeEnum;
use App\Utilities\ApiOutput;
use Exception;
use Closure;
use App\Utilities\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $user = Auth::user();
            if($user->user_type != UserTypeEnum::agency) throw new Exception("Permission denied");
            
            return $next($request);

        }catch(Exception $e){
            return ApiOutput::permission_denied();
        }
    }
}
