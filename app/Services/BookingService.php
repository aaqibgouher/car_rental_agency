<?php

namespace App\Services;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\Rule;
use App\Models\CarModel;
use App\Utilities\Common;
use App\Models\BookingModel;
use App\Services\CarService;
use App\Models\Enums\UserTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Models\Enums\IsDeletedEnum;
use App\Models\Enums\IsAvailableEnum;

interface BookingInterface{
    public static function add($user_id, $car_id, $number_of_days, $from_date, $params = []);
    public static function get_ongoing_booking();
    public static function get_booking_history();
}

class BookingService implements BookingInterface
{
    public static function add($user_id, $car_id, $number_of_days, $from_date, $params = [])
    {
        $validator = Validator::make(compact("user_id", "car_id", "number_of_days", "from_date", "to_date"), [
            "user_id" => Rule::get("id", true),
            "car_id" => Rule::get("id", true),
            "number_of_days" => Rule::get("capacity", true),
            "from_date" => Rule::get("date", true),
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $car = CarService::get_available_car($car_id);
        
        if(!$car) throw new Exception("Car is unavailable");
        
        $to_date = Common::get_to_date($from_date, $number_of_days);
        $total_fare = $number_of_days * $car->rent_per_day;

        $booking_id = BookingModel::insertGetId([
            "user_id" => $user_id,
            "car_id" => $car_id,
            "number_of_days" => $number_of_days,
            "from_date" => $from_date,
            'to_date' => $to_date,
            'total_fare' => $total_fare,
            'is_deleted' => IsDeletedEnum::not_deleted,
            'created_at' => Common::now(),
            'updated_at' => Common::now(),
            'updated_by' => null
        ]);

        $params = [
            "is_available" => IsAvailableEnum::unavailable,
            "updated_at" => Common::now()
        ];

        CarService::edit($car_id, $params);

        return [ "booking_id" => $booking_id ];
    }

    public static function get_ongoing_booking() 
    {
        $user_id = Auth::id();

        $booking = DB::table('bookings')->where('user_id', '=', $user_id)->where('to_date', ">=", Common::date())->get();
        return $booking;
    }

    public static function get_booking_history() {
        $user_id = Auth::id();

        $booking = DB::table('bookings')->where('user_id', '=', $user_id)->where('to_date', "<", Common::date())->get();
        return $booking;
    }
}
