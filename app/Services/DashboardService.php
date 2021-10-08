<?php

namespace App\Services;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\Rule;
use App\Models\CarModel;
use App\Utilities\Common;
use App\Services\CarService;
use App\Models\Enums\UserTypeEnum;
use App\Models\Enums\IsDeletedEnum;

interface DashboardInterface{
    public static function dashboard();
}

class DashboardService implements DashboardInterface
{
    public static function dashboard() {
        $data = [];

        $data['total_cars'] = CarService::get_total_cars()->count();
        $data['total_available_cars'] = CarService::get_total_available_cars()->count();
        $data['total_booked_cars'] = CarService::total_booked_cars()->count();
        return $data;
    }

}
