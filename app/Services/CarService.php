<?php

namespace App\Services;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\Rule;
use App\Models\CarModel;
use App\Models\Enums\IsAvailableEnum;
use App\Utilities\Common;
use App\Models\Enums\UserTypeEnum;
use App\Models\Enums\IsDeletedEnum;

interface CarInterface{
    public static function get_unbooked_cars();
    public static function add($vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $is_available);
    public static function edit($id, $params=[]);
    public static function get_by_id($id);
    public static function get_by_vehicle_number($vehicle_number);
    public static function get_total_cars();
    public static function get_total_available_cars();
    public static function total_booked_cars();
    public static function get_booked_cars_list();
    public static function get_available_car($id);
}

class CarService implements CarInterface
{
    public static function get_unbooked_cars() {
        return CarModel::where('is_available', 1)->where('is_deleted', IsDeletedEnum::not_deleted)->get();
    }

    public static function add($vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $is_available)
    {
        $validator = Validator::make(compact("vehicle_model", "vehicle_number", "seating_capacity", "rent_per_day", "is_available"), [
            "vehicle_model" => Rule::get("name", true),
            "vehicle_number" => Rule::get("name", true),
            "seating_capacity" => Rule::get("capacity", true),
            "rent_per_day" => Rule::get("rent", true),
            "is_available" => Rule::get("available", true)
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $car = CarService::get_by_vehicle_number($vehicle_number);
        
        if($car) throw new Exception("Vehicle Number is Already Taken");

        $car_id = CarModel::insertGetId([
            "user_id" => Auth::id(),
            "vehicle_model" => $vehicle_model,
            "vehicle_number" => $vehicle_number,
            "seating_capacity" => $seating_capacity,
            "rent_per_day" => $rent_per_day,
            "is_available" => $is_available,
            "is_deleted" => IsDeletedEnum::not_deleted,
            "created_at" => Common::now(),
            "updated_at" => Common::now(),
            "updated_by" => Auth::id()
        ]);

        return [ "id" => $car_id ];
    }

    public static function edit($id, $params=[])
    {
        $validator = Validator::make($params, [
            "vehicle_model" => Rule::get('name'),
            "vehicle_number" => Rule::get('name'),
            "seating_capacity" => Rule::get('capacity'),
            "rent_per_day" => Rule::get("rent"),
            "is_available" => Rule::get("available"),
            "updated_at" => Rule::get("datetime"),
            "updated_by" => Rule::get("id"),
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        if ($params && array_key_exists("vehicle_number", $params) && $params["vehicle_number"]) {
            $car = CarService::get_by_vehicle_number($params["vehicle_number"]);
        
            if($car && $car->id != $id) throw new Exception("Vehicle Number is Already Taken");
        }

        $car = CarService::get_by_id($id);

        if(!$car) throw new Exception("Invalid car id");

        // user_params
        $car_params = [];
        if ($params && array_key_exists("vehicle_model", $params)) $car_params["vehicle_model"] = $params["vehicle_model"];
        if ($params && array_key_exists("vehicle_number", $params)) $car_params["vehicle_number"] = $params["vehicle_number"];
        if ($params && array_key_exists("seating_capacity", $params)) $car_params["seating_capacity"] = $params["seating_capacity"];
        if ($params && array_key_exists("rent_per_day", $params)) $car_params["rent_per_day"] = $params["rent_per_day"];
        if ($params && array_key_exists("is_available", $params)) $car_params["is_available"] = $params["is_available"];
        if ($params && array_key_exists("updated_by", $params)) $car_params["updated_by"] = $params["updated_by"] ? $params["updated_by"] : null;
        if ($params && !array_key_exists("updated_by", $params)) $car_params["updated_by"] = $car->updated_by ? $car->updated_by : null;
        $car_params['updated_at'] = Common::now();

        CarModel::where('id', $id)->update($car_params);
    }

    public static function get_by_id($id) {
        return CarModel::where('id', $id)->where('is_deleted', IsDeletedEnum::not_deleted)->first();
    }

    public static function get_by_vehicle_number($vehicle_number) {
        return CarModel::where('vehicle_number', $vehicle_number)->where('is_deleted', IsDeletedEnum::not_deleted)->first();
    }

    public static function get_total_cars() {
        return CarModel::where('is_deleted', IsDeletedEnum::not_deleted)->get();
    }

    public static function get_total_available_cars() {
        return CarModel::where('is_available', IsAvailableEnum::available)->where('is_deleted', IsDeletedEnum::not_deleted)->get();
    }

    public static function total_booked_cars() {
        return CarModel::where('is_available', IsAvailableEnum::unavailable)->where('is_deleted', IsDeletedEnum::not_deleted)->get();
    }

    public static function get_booked_cars_list() {
        return CarModel::where('is_available', IsAvailableEnum::unavailable)->where('is_deleted', IsDeletedEnum::not_deleted)->get();
    }

    public static function get_available_car($id) {
        return CarModel::where('id', $id)->where('is_available', IsAvailableEnum::available)->where('is_deleted', IsDeletedEnum::not_deleted)->first();
    }
}
