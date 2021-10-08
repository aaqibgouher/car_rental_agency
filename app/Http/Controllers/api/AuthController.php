<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Utilities\Auth;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller{

    public function __construct()
    {
        DB::beginTransaction();
    }

    public function register(Request $request)
    {
        try {
            $user_type = trim($request->input('user_type'));
            $first_name = trim($request->input('first_name'));
            $last_name = trim($request->input('last_name'));
            $email = trim($request->input('email'));
            $password = trim($request->input('password'));
            
            $data = [];

            $data = AuthService::register($user_type, $first_name, $last_name, $email, $password);

            DB::commit();
            return ApiOutput::success("successfully registered", $data);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $email = trim($request->input('email'));
            $password = trim($request->input('password'));

            $data = AuthService::login($email, $password);

            DB::commit();
            return ApiOutput::success("successfully login", $data);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try{
            AuthService::logout(Auth::id());

            DB::commit();
            return ApiOutput::success("successfully logout");
        }catch(Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }
}
