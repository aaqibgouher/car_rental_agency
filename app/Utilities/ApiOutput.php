<?php

namespace App\Utilities;

class ApiOutput{
    public static function success($message = "", $data = []){
        return ApiOutput::output(200, $message, $data);
    }

    public static function error($message = ""){
        return ApiOutput::output(400, $message);
    }

    public static function permission_denied(){
        return ApiOutput::output(403, 'Permission Denied.', []);
    }

    public static function output($status = 200, $message = "", $data = []){
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
    }
}