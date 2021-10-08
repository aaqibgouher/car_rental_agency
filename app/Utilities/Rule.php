<?php

namespace App\Utilities;

class Rule
{
    public static function get($key, $is_required = false)
    {
        $data = [
            "rent" => "integer|min:0",
            "capacity" => "integer|min:1",
            "id" => "integer|min:0",
            "email" => "string|email|max:255",
            "password" => "string|min:6|max:50",
            "name" => "string|max:50",
            "boolean" => "integer|in:0,1",
            // "status" => Rule::status("status"),
            "user_type" => "in:0, 1",
            "available" => "in:0, 1",
            "date" => "regex:/^[123][0-9]{3}-[01][0-9]-[0123][0-9]$/|max:10",
            "datetime" => "regex:/^[123][0-9]{3}-[01][0-9]-[0123][0-9] [012][0-9]:[0-5][0-9]:[0-5][0-9]$/",
            "category_name" => "string|max:200",
            "category_description" => "string|max:200",
            "slug" => "regex:/^[a-z][-a-z0-9]*$/|max:200",
            "blog_title" => "string|max:200",
            "blog_content" => "string",
            "text_100" => "string|max:100",
            "text_200" => "string|max:200",
            "text" => "string",
            "array" => "array",
            "otp" => "integer|digits:6",
            "page" => "integer|min:0",
            "limit" => "integer|min:0",
            "search" => "string|max:100",
            "order_type" => "string|in:asc,desc",
            "order" => "integer|min:1",
            "image" => "image",
        ];

        $rule = array_key_exists($key, $data) ? $data[$key] : '';

        if ($is_required) {
            $rule = "required|" . $rule;
        }else{
            $rule = "nullable|" . $rule;
        }

        return $rule;
    }

    // public static function status($type = "status")
    // {
    //     $data = [];
    //     switch ($type) { 
    //         case "status":
    //             $data = StatusEnum::get();
    //             break;
    //         case "user_type":
    //             $data = UserTypeEnum::get();
    //             break;
    //         default:
    //             $data = StatusEnum::get();
    //             break;
    //     }
    //     $data = array_keys($data);
    //     return "in:" . implode(",", $data);
    // }
}
