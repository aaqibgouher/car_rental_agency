<?php

namespace App\Http\Controllers\api;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\Rule;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile(Request $request) 
    {
        try{
            $data = [];

            $data = Auth::user();

            return ApiOutput::success("Successfully get the profile", $data);
        }catch(Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }

    public function edit(Request $request) 
    {
        try{
            $validator = Validator::make($request->all(), [
                "first_name" => Rule::get('name', true),
                "last_name" => Rule::get('name', true)
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $first_name = trim($request->input('first_name'));
            $last_name = trim($request->input('last_name'));

            $params = [
                "first_name" => $first_name,
                "last_name" => $last_name
            ];

            UserService::edit(Auth::id(), $params);

            return ApiOutput::success("Successfully edit your profile");
        }catch(Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }
}
