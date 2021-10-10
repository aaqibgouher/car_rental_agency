<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        try {
            $data = [];

            $data = DashboardService::dashboard();

            return ApiOutput::success("welcome in dashboard", $data);
        } catch (Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }
}
