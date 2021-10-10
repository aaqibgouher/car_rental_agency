<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use App\Services\FrontendService;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function list(Request $request) {
        try {
            $data = [];

            $data = FrontendService::list();

            return ApiOutput::success("sucessfully get the available cars", $data);
        } catch (Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }
}
