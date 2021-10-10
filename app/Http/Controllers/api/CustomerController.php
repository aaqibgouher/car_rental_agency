<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\ApiOutput;
use Exception;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        try{
            $data = [];

            

            return ApiOutput::success("Successfully get the customers who rented a car", $data);
        }catch(Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }
}
