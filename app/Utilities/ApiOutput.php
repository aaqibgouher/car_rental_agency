<?php

namespace App\Utilities;

class ApiOutput{
    public static function success($message = "", $data = []){
        return ApiOutput::output(200, $message, $data);
    }

    public static function error($message = ""){
        return ApiOutput::output(400, $message);
    }

    public static function unauthorize(){
        return ApiOutput::output(401, "Please Login To Continue.");
    }

    public static function unauthorize_user(){
        return ApiOutput::output(401.1, "Please Login To Continue.");
    }

    public static function permission_denied(){
        return ApiOutput::output(403, 'Permission Denied.', []);
    }

    public static function not_found(){
        return ApiOutput::output(404, 'Sorry, data not found.', []);
    }    

    public static function output($status = 200, $message = "", $data = []){
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
    }
}