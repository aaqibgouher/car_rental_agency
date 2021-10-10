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

interface FrontendInterface{
    public static function list();
}

class FrontendService implements FrontendInterface
{
    public static function list() {
        $data = [];

        $data['total_available_cars'] = CarService::get_total_available_cars();

        return $data;
    }

}
