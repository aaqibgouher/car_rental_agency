<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Utilities\Auth;
use App\Services\CarService;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CarModel;

class CarController extends Controller
{
    public function __construct()
    {
        DB::beginTransaction();
    }
    
    public static function list(Request $request) {
        try {
            $data = [];

            $data = CarService::get_unbooked_cars();

            return ApiOutput::success("successfully get the data", $data);
        } catch (Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }

    public static function add(Request $request) {
        try {
            $vehicle_model = trim($request->input('vehicle_model'));
            $vehicle_number = trim($request->input('vehicle_number'));
            $seating_capacity = trim($request->input('seating_capacity'));
            $rent_per_day = trim($request->input('rent_per_day'));
            $is_available = trim($request->input('is_available'));

            $data = [];

            $data = CarService::add($vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $is_available);
            
            DB::commit();
            return ApiOutput::success("successfully added a car", $data);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public static function edit(Request $request, $id) {
        try{
            $req = $request->all();

            $params = [
                "updated_by" => Auth::id(),
            ];
            if ($req && array_key_exists("vehicle_model", $req)) $params["vehicle_model"] = trim($req["vehicle_model"]);
            if ($req && array_key_exists("vehicle_number", $req)) $params["vehicle_number"] = trim($req["vehicle_number"]);
            if ($req && array_key_exists("seating_capacity", $req)) $params["seating_capacity"] = trim($req["seating_capacity"]);
            if ($req && array_key_exists("rent_per_day", $req)) $params["rent_per_day"] = trim($req["rent_per_day"]);
            if ($req && array_key_exists("is_available", $req)) $params["is_available"] = trim($req["is_available"]);
            
            CarService::edit($id, $params);

            DB::commit();
            return ApiOutput::success("successfully edit a car");
        }catch(Exception $e) {  
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public static function booked_car_list(Request $request)
    {
        try{
            $data = [];

            $data = CarService::get_booked_cars_list();

            return ApiOutput::success("successfully get the booked cars list", $data);
        }catch(Exception $e) {
            return ApiOutput::error($e->getMessage());
        }
    }
}
