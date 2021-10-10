<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Utilities\Auth;
use App\Utilities\ApiOutput;
use App\Models\Enums\UserTypeEnum;

class IsCustomerMiddleware
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
            if($user->user_type === UserTypeEnum::agency) throw new Exception("You are not allowed to booking");
            
            return $next($request);

        }catch(Exception $e){
            return ApiOutput::error($e->getMessage());
        }
    }
}
